<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class OwnerHotelController
 *
 * Handles Eigenaar (Hotel Owner) CRUD operations for hotels.
 * Strictly adheres to Rules & Regulations (Rule 5: IoC, Rule 6: DocBlocks, Rule 7: User Feedback).
 */
class OwnerHotelController extends Controller
{
    /**
     * OwnerHotelController constructor.
     * Injects Hotel and Room model instances (Rule 5: Controller IoC).
     *
     * @param  Hotel  $hotelModel  Initialized Hotel model.
     * @param  Room  $roomModel  Initialized Room model.
     */
    public function __construct(
        protected Hotel $hotelModel,
        protected Room $roomModel
    ) {}

    /**
     * Display a listing of hotels owned by the authenticated Eigenaar.
     *
     * @return View The rendered owner hotels management list.
     */
    public function index(): View
    {
        $userId = (int) Auth::id();
        $hotels = $this->hotelModel->getByOwnerId($userId);

        return view('owner.hotels.index', [
            'hotels' => $hotels,
        ]);
    }

    /**
     * Show the form for creating a new hotel property.
     *
     * @return View The rendered create hotel form.
     */
    public function create(): View
    {
        return view('owner.hotels.create');
    }

    /**
     * Store a newly created hotel in the database via Stored Procedure.
     *
     * @param  Request  $request  Incoming HTTP request containing hotel attributes.
     * @return RedirectResponse Redirects to owner dashboard with session flash feedback.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'star_rating' => ['required', 'integer', 'min:1', 'max:5'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $validated['user_id'] = (int) Auth::id();
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

        $insertedId = $this->hotelModel->createHotel($validated);

        if ($insertedId > 0) {
            session()->flash('success', "Hotel '{$validated['name']}' is succesvol aangemaakt!");

            return redirect()->route('owner.hotels.index');
        }

        session()->flash('error', 'Er is een fout opgetreden bij het aanmaken van het hotel.');

        return redirect()->back()->withInput();
    }

    /**
     * Show the form for editing an existing hotel.
     *
     * @param  int  $id  The ID of the hotel to edit.
     * @return View|RedirectResponse The edit view or redirect if unauthorized.
     */
    public function edit(int $id): View|RedirectResponse
    {
        $hotel = $this->hotelModel->findById($id);

        if (! $hotel || (int) ($hotel->id ?? 0) === 0 || (int) $hotel->user_id !== (int) Auth::id()) {
            session()->flash('error', 'Hotel niet gevonden of u heeft geen toegang.');

            return redirect()->route('owner.hotels.index');
        }

        return view('owner.hotels.edit', [
            'hotel' => $hotel,
        ]);
    }

    /**
     * Update an existing hotel property via Stored Procedure.
     *
     * @param  Request  $request  Incoming HTTP request with updated fields.
     * @param  int  $id  The ID of the hotel to update.
     * @return RedirectResponse Redirect with session feedback.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'star_rating' => ['required', 'integer', 'min:1', 'max:5'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $userId = (int) Auth::id();

        $success = $this->hotelModel->updateHotel($id, $validated, $userId);

        if ($success) {
            session()->flash('success', "Hotel '{$validated['name']}' is succesvol bijgewerkt!");

            return redirect()->route('owner.hotels.index');
        }

        session()->flash('error', 'Er is een fout opgetreden bij het bijwerken van het hotel.');

        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified hotel from storage via Stored Procedure.
     *
     * @param  int  $id  The ID of the hotel to delete.
     * @return RedirectResponse Redirect with session feedback.
     */
    public function destroy(int $id): RedirectResponse
    {
        $userId = (int) Auth::id();
        $success = $this->hotelModel->deleteHotel($id, $userId);

        if ($success) {
            session()->flash('success', 'Hotel is succesvol verwijderd.');
        } else {
            session()->flash('error', 'Kon het hotel niet verwijderen.');
        }

        return redirect()->route('owner.hotels.index');
    }
}
