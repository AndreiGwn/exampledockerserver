<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Class ReservationController
 *
 * Handles public guest reservations and the "Reserved" tab for GSHotel.
 */
class ReservationController extends Controller
{
    /**
     * Display the "Reserved" tab with all reservations made by the guest.
     */
    public function index(Request $request): View
    {
        $sessionCodes = $request->session()->get('guest_reservations', []);
        $sessionId = $request->session()->getId();

        // Retrieve reservations belonging to current session or session reservation codes
        $reservations = Reservation::with(['hotel.amenities', 'room'])
            ->where(function ($query) use ($sessionCodes, $sessionId) {
                if (! empty($sessionCodes)) {
                    $query->whereIn('reservation_code', $sessionCodes);
                }
                if ($sessionId) {
                    $query->orWhere('session_id', $sessionId);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $hotels = Hotel::with(['rooms', 'amenities'])->get();
        $cities = Hotel::distinct()->pluck('city')->toArray();

        return view('welcome', [
            'hotels' => $hotels,
            'cities' => $cities,
            'filters' => [],
            'totalResults' => $hotels->count(),
            'reservations' => $reservations,
            'initialTab' => 'reserved',
            'initialHotelId' => null,
        ]);
    }

    /**
     * Store a new guest reservation (No login required).
     *
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_id' => 'nullable|exists:rooms,id',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:50',
            'guest_address' => 'nullable|string|max:255',
            'check_in' => 'nullable|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
            'guests_count' => 'nullable|integer|min:1|max:10',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        // Generate unique luxury reservation reference code
        $code = 'GSH-'.strtoupper(Str::random(6));

        $reservation = Reservation::create([
            'reservation_code' => $code,
            'hotel_id' => $validated['hotel_id'],
            'room_id' => $validated['room_id'] ?? null,
            'guest_name' => $validated['guest_name'],
            'guest_email' => $validated['guest_email'],
            'guest_phone' => $validated['guest_phone'],
            'guest_address' => $validated['guest_address'] ?? null,
            'check_in' => $validated['check_in'] ?? now()->addDay()->toDateString(),
            'check_out' => $validated['check_out'] ?? now()->addDays(4)->toDateString(),
            'guests_count' => $validated['guests_count'] ?? 2,
            'special_requests' => $validated['special_requests'] ?? null,
            'session_id' => $request->session()->getId(),
            'status' => 'Confirmed',
        ]);

        // Store reservation code in visitor session
        $request->session()->push('guest_reservations', $code);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for reserving with GSHotel! Your reservation has been confirmed.',
                'reservation_code' => $code,
                'reservation' => $reservation->load(['hotel.amenities', 'room']),
                'redirect_url' => route('reservations.index'),
            ]);
        }

        return redirect()->route('reservations.index')->with(
            'success',
            "Thank you for reserving! Your reservation ({$code}) for {$reservation->hotel->name} has been confirmed."
        );
    }

    /**
     * Look up past reservations by reservation code or email.
     *
     * @return JsonResponse|RedirectResponse
     */
    public function lookup(Request $request)
    {
        $query = trim($request->input('lookup_query', ''));

        if (empty($query)) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Please enter a reservation code or email address.']);
            }

            return redirect()->route('reservations.index')->with('error', 'Please enter a reservation code or email address.');
        }

        $found = Reservation::with(['hotel.amenities', 'room'])
            ->where('reservation_code', strtoupper($query))
            ->orWhere('guest_email', $query)
            ->get();

        if ($found->isEmpty()) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => "No reservations found matching '{$query}'."]);
            }

            return redirect()->route('reservations.index')->with('error', "No reservations found matching '{$query}'.");
        }

        foreach ($found as $res) {
            $sessionCodes = session()->get('guest_reservations', []);
            if (! in_array($res->reservation_code, $sessionCodes)) {
                session()->push('guest_reservations', $res->reservation_code);
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Found {$found->count()} reservation(s).",
                'reservations' => $found,
            ]);
        }

        return redirect()->route('reservations.index')->with('success', "Found {$found->count()} reservation(s).");
    }

    /**
     * Cancel an existing reservation.
     *
     * @return JsonResponse|RedirectResponse
     */
    public function destroy(Request $request, string $code)
    {
        $reservation = Reservation::where('reservation_code', $code)->first();

        if ($reservation) {
            $reservation->delete();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Reservation {$code} has been successfully cancelled.",
                ]);
            }

            return redirect()->route('reservations.index')->with('info', "Reservation {$code} has been successfully cancelled.");
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Reservation could not be found.',
            ], 404);
        }

        return redirect()->route('reservations.index')->with('error', 'Reservation could not be found.');
    }
}
