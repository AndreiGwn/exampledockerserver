<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class OwnerRoomController
 *
 * Handles Eigenaar (Hotel Owner) CRUD operations for hotel rooms.
 * Strictly adheres to Rules & Regulations (Rule 5: IoC, Rule 6: DocBlocks, Rule 7: User Feedback).
 *
 * @package App\Http\Controllers
 */
class OwnerRoomController extends Controller
{
    /**
     * OwnerRoomController constructor.
     * Injects Room and Hotel models (Rule 5: Controller IoC).
     *
     * @param Room $roomModel Initialized Room model wrapper.
     * @param Hotel $hotelModel Initialized Hotel model wrapper.
     */
    public function __construct(
        protected Room $roomModel,
        protected Hotel $hotelModel
    ) {}

    /**
     * Display a listing of rooms for a specific hotel.
     *
     * @param int $hotelId The unique identifier of the hotel.
     * @return View|RedirectResponse The room listing view or error redirect.
     */
    public function index(int $hotelId): View|RedirectResponse
    {
        $hotel = $this->hotelModel->findById($hotelId);

        if (!$hotel || (int) ($hotel->id ?? 0) === 0 || (int) $hotel->user_id !== (int) Auth::id()) {
            session()->flash('error', 'Hotel niet gevonden of u heeft geen toegang.');

            return redirect()->route('owner.hotels.index');
        }

        $rooms = $this->roomModel->getByHotelId($hotelId);

        return view('owner.rooms.index', [
            'hotel' => $hotel,
            'rooms' => $rooms,
        ]);
    }

    /**
     * Show the form for creating a new room for a hotel.
     *
     * @param int $hotelId The hotel ID.
     * @return View The create room form.
     */
    public function create(int $hotelId): View
    {
        $hotel = $this->hotelModel->findById($hotelId);

        return view('owner.rooms.create', [
            'hotel' => $hotel,
        ]);
    }

    /**
     * Store a newly created room in the database via Stored Procedure.
     *
     * @param Request $request Incoming HTTP request.
     * @param int $hotelId The hotel ID.
     * @return RedirectResponse Redirect with feedback.
     */
    public function store(Request $request, int $hotelId): RedirectResponse
    {
        $hotel = $this->hotelModel->findById($hotelId);

        if (!$hotel || (int) ($hotel->id ?? 0) === 0 || (int) $hotel->user_id !== (int) Auth::id()) {
            session()->flash('error', 'Geen toestemming om kamers toe te voegen aan dit hotel.');

            return redirect()->route('owner.hotels.index');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'room_type' => ['required', 'string', 'max:100'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'capacity' => ['required', 'integer', 'min:1', 'max:10'],
            'beds' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'is_available' => ['nullable', 'boolean'],
        ]);

        $validated['hotel_id'] = $hotelId;
        $validated['is_available'] = $request->has('is_available') ? 1 : 0;

        $insertedId = $this->roomModel->createRoom($validated);

        if ($insertedId > 0) {
            session()->flash('success', "Kamer '{$validated['name']}' is succesvol toegevoegd!");

            return redirect()->route('owner.rooms.index', $hotelId);
        }

        session()->flash('error', 'Er is een fout opgetreden bij het toevoegen van de kamer.');

        return redirect()->back()->withInput();
    }

    /**
     * Show the form for editing an existing room.
     *
     * @param int $hotelId The hotel ID.
     * @param int $roomId The room ID.
     * @return View|RedirectResponse
     */
    public function edit(int $hotelId, int $roomId): View|RedirectResponse
    {
        $hotel = $this->hotelModel->findById($hotelId);

        if (!$hotel || (int) ($hotel->id ?? 0) === 0 || (int) $hotel->user_id !== (int) Auth::id()) {
            session()->flash('error', 'Geen toegang tot dit hotel.');

            return redirect()->route('owner.hotels.index');
        }

        $rooms = $this->roomModel->getByHotelId($hotelId);
        $room = collect($rooms)->firstWhere('id', $roomId);

        if (!$room) {
            session()->flash('error', 'Kamer niet gevonden.');

            return redirect()->route('owner.rooms.index', $hotelId);
        }

        return view('owner.rooms.edit', [
            'hotel' => $hotel,
            'room' => $room,
        ]);
    }

    /**
     * Update an existing room via Stored Procedure.
     *
     * @param Request $request
     * @param int $hotelId
     * @param int $roomId
     * @return RedirectResponse
     */
    public function update(Request $request, int $hotelId, int $roomId): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'room_type' => ['required', 'string', 'max:100'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'capacity' => ['required', 'integer', 'min:1', 'max:10'],
            'beds' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'is_available' => ['nullable', 'boolean'],
        ]);

        $validated['is_available'] = $request->has('is_available') ? 1 : 0;

        $success = $this->roomModel->updateRoom($roomId, $validated);

        if ($success) {
            session()->flash('success', "Kamer '{$validated['name']}' is succesvol bijgewerkt!");

            return redirect()->route('owner.rooms.index', $hotelId);
        }

        session()->flash('error', 'Kon de kamer niet bijwerken.');

        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified room via Stored Procedure.
     *
     * @param int $hotelId
     * @param int $roomId
     * @return RedirectResponse
     */
    public function destroy(int $hotelId, int $roomId): RedirectResponse
    {
        $success = $this->roomModel->deleteRoom($roomId);

        if ($success) {
            session()->flash('success', 'Kamer is succesvol verwijderd.');
        } else {
            session()->flash('error', 'Kon de kamer niet verwijderen.');
        }

        return redirect()->route('owner.rooms.index', $hotelId);
    }
}
