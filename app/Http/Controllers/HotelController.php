<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class HotelController
 *
 * Public-facing controller for the Trivago-style hotel search engine and hotel details view.
 * Implements Controller Inversion of Control (Rule 5) and Mandatory DocBlock comments (Rule 6).
 */
class HotelController extends Controller
{
    /**
     * HotelController constructor.
     * Injects the Hotel and Room model dependencies (Rule 5: Controller Inversion of Control).
     *
     * @param  Hotel  $hotelModel  Initialized Hotel model wrapper for Stored Procedures.
     * @param  Room  $roomModel  Initialized Room model wrapper for Stored Procedures.
     */
    public function __construct(
        protected Hotel $hotelModel,
        protected Room $roomModel
    ) {}

    /**
     * Display the Trivago-style hotel search homepage with filterable results.
     *
     * @param  Request  $request  Incoming HTTP request containing search parameters (q, city, min_price, max_price, min_star, capacity, sort_by).
     * @return View The rendered welcome/search view with hotel list and cities.
     */
    public function index(Request $request): View
    {
        $hasFilters = $request->filled('q')
            || ($request->filled('city') && $request->get('city') !== 'All')
            || $request->filled('min_price')
            || $request->filled('max_price')
            || $request->filled('min_star')
            || $request->filled('capacity')
            || $request->filled('sort_by');

        if ($hasFilters) {
            $hotels = $this->hotelModel->search($request->all());
        } else {
            $hotels = $this->hotelModel->getAll();
        }

        $cities = $this->hotelModel->getDistinctCities();

        return view('welcome', [
            'hotels' => $hotels,
            'cities' => $cities,
            'filters' => $request->all(),
            'totalResults' => count($hotels),
        ]);
    }

    /**
     * Display detailed information, rooms, amenities, and reviews for a single hotel.
     *
     * @param  int  $id  The unique identifier of the hotel to display.
     * @return View The rendered hotel detail view.
     */
    public function show(int $id): View
    {
        $hotel = $this->hotelModel->findById($id);

        if ((int) ($hotel->id ?? 0) === 0) {
            abort(404, 'Hotel niet gevonden.');
        }

        $rooms = $this->roomModel->getByHotelId($id);

        return view('hotels.show', [
            'hotel' => $hotel,
            'rooms' => $rooms,
        ]);
    }
}
