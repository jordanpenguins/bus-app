<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Schedule;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function schedule(Request $request){
        // display all the schedules available based on the criteria given the criteria from post request
        Log::info($request->all());

        $ticketType = $request->ticket_type;
        $departureDate = $request -> departure_date;
        $departureRoute = $request-> departure_route;

        $returnRoute = $request->return_route;
        $returnDate = $request -> return_date;
        $passengerQty = $request -> passenger_qty;

       // check for departure tickets
        
        $routes = Route::find($departureRoute);
        $formattedDepartureDate = date("Y-m-d", strtotime($departureDate));
        $schedule = Schedule::where('route_id', $routes->id)
                            ->whereDate('scheduled_date', $formattedDepartureDate)
                            ->get();

        if ($schedule ->count() <= 0) {
            // handle case where route is not found
            return;
        }               
        
        
        // check if departure and return exist 
        if ($ticketType === 'two_way') {
            Log::info($returnRoute);
            $routes = Route::find($returnRoute);
            if ($routes->count() <= 0) {
                // handle case where route is not found
                return;
            }

            $formattedReturnDate = date("Y-m-d", strtotime($returnDate));
            $returnSchedule = Schedule::where('route_id', $routes->id)
                                ->whereDate('scheduled_date', $formattedReturnDate)
                                ->get();

            if ($returnSchedule ->count() <= 0) {
                // handle case where route is not found
                return;
            }   

            Log::info($returnSchedule);
        }



        // check for all the booked seats

    
        return view ('seats');

    }



    public function index() {
        // display all the routes available 

        $routes = Route::all();
        return view ('purchase', compact('routes'));
    
    }


}
