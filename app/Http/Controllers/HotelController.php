<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class HotelController
 *
 * Public portal controller for GSHotel 4-5 star hotel discovery & details.
 */
class HotelController extends Controller
{
    /**
     * HotelController constructor.
     */
    public function __construct(
        protected Hotel $hotelModel,
        protected Room $roomModel
    ) {}

    /**
     * Display the GSHotel luxury discovery homepage with 4-5 star hotels and SPA navigation.
     */
    public function index(Request $request): View
    {
        $filters = $request->all();
        $hotels = $this->hotelModel->search($filters);
        $cities = $this->hotelModel->getDistinctCities();

        $sessionCodes = $request->session()->get('guest_reservations', []);
        $sessionId = $request->session()->getId();

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

        return view('welcome', [
            'hotels' => $hotels,
            'cities' => $cities,
            'filters' => $filters,
            'totalResults' => $hotels->count(),
            'reservations' => $reservations,
            'initialTab' => $request->get('tab', 'explore'),
            'initialHotelId' => null,
        ]);
    }

    /**
     * Display detailed sanctuary view for a specific 4-5 star hotel (supports direct URL with SPA state).
     */
    public function show(Request $request, int $id): View
    {
        $hotel = Hotel::with(['rooms', 'amenities'])->find($id);

        if (! $hotel) {
            abort(404, 'Hotel sanctuary not found.');
        }

        $hotels = Hotel::with(['rooms', 'amenities'])->get();
        $cities = $this->hotelModel->getDistinctCities();

        $sessionCodes = $request->session()->get('guest_reservations', []);
        $sessionId = $request->session()->getId();

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

        return view('welcome', [
            'hotels' => $hotels,
            'cities' => $cities,
            'filters' => [],
            'totalResults' => $hotels->count(),
            'reservations' => $reservations,
            'initialTab' => 'details',
            'initialHotelId' => $id,
        ]);
    }
}
