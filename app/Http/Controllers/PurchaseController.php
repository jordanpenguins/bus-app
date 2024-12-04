<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Price;
use Stripe\Stripe;
use Illuminate\Support\Facades\Response;

class PurchaseController extends Controller
{
    public function schedule(Request $request){
        // display all the schedules available based on the criteria given the criteria from post request
        Log::info($request->all());

        $ticketType = $request->ticket_type;
        $departureDate = $request -> departure_date;
        $departureRoute = $request-> departure_route;
        $departureTime = $request -> departure_time;
        $selectedDepartureTime = $request ->selected_departure_time;
        $departingSeats = $request -> departing_seats;

        $returnRoute = $request->return_route;
        $returnDate = $request -> return_date;
        $returnTime = $request -> return_time;
        $selectedReturnTime = $request -> selected_return_time;
        $passengerQty = $request -> passenger_qty;
        $returnSeats = $request -> returning_seats;
        $returnSchedule = null;
        

       // check for departure tickets
        
        $routes = Route::find($departureRoute);
        $formattedDepartureDate = date("Y-m-d", strtotime($departureDate));
        $scheduleQuery = Schedule::where('route_id', $routes->id)
                            ->whereDate('scheduled_date', $formattedDepartureDate);
                            
        $schedule = $scheduleQuery->get();

        if ($schedule ->count() <= 0) {
            // handle case where route is not found
            return;
        }   

        $departureRouteName = Route::where('id',$departureRoute)->first();
        
        if ($departureTime) {
            $firstDepartSchedule = $scheduleQuery -> whereTime('departure_time', $departureTime)->get()->first();
        } else {
            $firstDepartSchedule = $schedule->first();
        }
        
        // pass in the first schedule_id into the view by passing the scheduled date and departure time to
        $departAvailability = $this->checkSeatAvailability($firstDepartSchedule);
        Log::info($departAvailability);
        
        // check if departure and return exist 
        if ($ticketType === 'two_way') {
            Log::info($returnRoute);

            $routes = Route::find($returnRoute);
            if ($routes->count() <= 0) {
                // handle case where route is not found
                return;
            }
            $returnRouteName = Route::where('id',$returnRoute)->first();
            $formattedReturnDate = date("Y-m-d", strtotime($returnDate));
            $returnScheduleQuery = Schedule::where('route_id', $routes->id)
                                ->whereDate('scheduled_date', $formattedReturnDate);
                                

            $returnSchedule = $returnScheduleQuery -> get();
            
            if ($returnSchedule ->count() <= 0) {
                // handle case where route is not found 
                return;
            }   
            if ($returnTime) {
                $firstReturnSchedule = $returnScheduleQuery -> whereTime('departure_time', $returnTime)->get()->first();
            } else {
                $firstReturnSchedule = $returnSchedule -> first();
            }
            
            $returnAvailability = $this->checkSeatAvailability($firstReturnSchedule);
            Log::info($returnAvailability);
            if ($selectedDepartureTime) {
                return view ('return-seats', compact('schedule','returnSchedule','firstReturnSchedule','firstDepartSchedule','returnAvailability','departAvailability','passengerQty','selectedReturnTime','departureRouteName','returnRouteName'));

            } else {
                return view ('seats', compact('schedule','returnSchedule','firstReturnSchedule','firstDepartSchedule','returnAvailability','departAvailability','passengerQty','returnSchedule','departureRouteName','returnRouteName'));

            }
            

        }



        // then display the available seats 
        return view ('seats', compact('schedule','firstDepartSchedule','departAvailability','passengerQty','returnSchedule','departureRouteName','departingSeats'));

    }



    public function checkSeatAvailability(Schedule $schedule)
    {
        // Get all seats for the bus
        $seats = Seat::where('bus_id', $schedule -> bus_id)->get();

        // Get all booked seats for the schedule
        $bookedSeats = Booking::where('schedule_id', $schedule->id)
                            ->where('status', 'confirmed')
                            ->pluck('seat_id')
                            ->toArray();

        // Determine available and unavailable seats (creates a temporary column when data is passed into the view)
        $seats->each(function ($seat) use ($bookedSeats) {
            $seat->available = !in_array($seat->id, $bookedSeats);
        });
    
        return $seats;
    }   

    public function checkout(Request $request)
    {
        Log::info($request->all());
        $ticketType = $request->ticket_type;
        $departureDate = $request -> departure_date;
        $departureRoute = $request-> departure_route;
        $departureTime = $request -> departure_time;
        $selectedDepartureTime = $request -> selected_departure_time;
        // departing seats
        $departingSeats = $request -> departing_seats; 
        

        $returnRoute = $request->return_route;
        $returnDate = $request -> return_date;
        $returnTime = $request -> return_time;
        $selectedReturnTime = $request -> selected_return_time;
        $passengerQty = $request -> passenger_qty;
        // returning seats
        $returningSeats = $request -> returning_seats;
        $returnPrice = 195.00;
        $returnSchedule = null;
        $returnAvailability = null;

    
        // Retrieve the departure schedule and availability
        $formattedDepartureDate = date("Y-m-d", strtotime($departureDate));
        $departureSchedule = Schedule::where('route_id', $departureRoute)
        ->whereDate('scheduled_date', $formattedDepartureDate)
        ->whereTime('departure_time', $selectedDepartureTime)
        ->first();

        // Log::info($departureSchedule);

        $departAvailability = $this->checkSeatAvailability($departureSchedule);
        
        // calculate the total price
        Log::info($departureSchedule);
      
        if ((int)$passengerQty > 0) {
            $adultPrice = $departureSchedule -> prices() -> where('type','adult') -> first() ;
            $totalAdultPrice = $this-> getProductPrice($adultPrice->priceID);


            $totalPrice = strtoupper($totalAdultPrice -> currency) . (string) (number_format((int)$passengerQty * ($totalAdultPrice -> amount / 100),2)) ;
        }

        // child ticket (future implementation)
        

        if ($ticketType === 'two_way') {
            $formattedReturnDate = date("Y-m-d", strtotime($returnDate));
            $returnSchedule = Schedule::where('route_id', $returnRoute)
                ->whereDate('scheduled_date', $formattedReturnDate)
                ->whereTime('departure_time', $returnTime)
                ->first();
            $returnAvailability = $this->checkSeatAvailability($returnSchedule);
            $returnRoute = Route::where('id',$returnRoute)->first();

            //calculate the total price for return
            $totalPrice = (int)$passengerQty * $returnPrice;
            

        }

        $departureRoute = Route::where('id',$departureRoute)->first();

        

        // return price should be fixed RM195 OR 60SGD 



        return view('checkout', compact(
        'ticketType', 'departureDate', 'departureRoute', 'departureTime', 'selectedDepartureTime',
        'returnRoute', 'returnDate', 'returnTime', 'passengerQty',
        'departureSchedule', 'departAvailability', 'returnSchedule', 'returnAvailability', 'departingSeats','returningSeats','totalPrice',
        ));


    }



    public function index() {
        // display all the routes available 

        $routes = Route::all();
        return view ('purchase', compact('routes'));
    
    }

    public function getProductPrice($priceId){
        // Fetch the price details
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $price =  Price::retrieve($priceId);
        Log::info($price);

        $amount = $price -> unit_amount;
        $currency = $price -> currency;
        return (object) ['amount' => $amount, 'currency' => $currency];
        
    }


}
