<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
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
     * Display the GSHotel luxury discovery homepage with 4-5 star hotels.
     */
    public function index(Request $request): View
    {
        $filters = $request->all();
        $hotels = $this->hotelModel->search($filters);
        $cities = $this->hotelModel->getDistinctCities();

        return view('welcome', [
            'hotels' => $hotels,
            'cities' => $cities,
            'filters' => $filters,
            'totalResults' => $hotels->count(),
        ]);
    }

    /**
     * Display detailed sanctuary view for a specific 4-5 star hotel.
     */
    public function show(int $id): View
    {
        $hotel = Hotel::with(['rooms', 'amenities'])->find($id);

        if (! $hotel) {
            abort(404, 'Hotel sanctuary not found.');
        }

        return view('hotels.show', [
            'hotel' => $hotel,
            'rooms' => $hotel->rooms,
            'amenities' => $hotel->amenities,
        ]);
    }
}
