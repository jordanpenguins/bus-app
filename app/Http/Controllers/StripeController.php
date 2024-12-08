<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function index() {

        Log::info("index");
        
    
    }

    public function checkout(Request $request) {

        // put passengers details into the session
        Log::info($request);
    
        // merge the existing 
        $passenger = $request -> all();
        Session::put("passenger",$passenger);

        $stripePriceId = 'price_1QRAnNHrbBfQ3SJwye8gCgKf';
        $quantity = (int)$request -> passenger_qty;
        return $request->user()->checkout([$stripePriceId => $quantity], [
            'success_url' => route('checkout-success'),
            'cancel_url' => route('checkout-cancel'),
        ]);

    }

    public function success(Request $request) {
        // when successful create a new booking for the user

        if (!Session::has('checkout') && !Session::has('passenger')){
            return;
        }

        $checkoutSession = Session::get('checkout');
        $passengerSession = Session::get('passenger');

        // create the receipt


        // each booking can have mutiple passengers 
        // each seats is occupied by multiple passengers

        // hardcode passenger details into the booking
        Log::info($checkoutSession['departureRoute']);

        // Departure Booking
        $booking = \App\Models\Booking::create([
            'user_id' => $request->user()->id,
            'schedule_id' => $checkoutSession['departureRoute'] -> id,
            'total_price' => (float)$checkoutSession['price'],
            'status' => 'confirmed',
        ]);

        // if return schedule exists, create a booking session for that as well

        // --TODO 



        // convert depature seats into an array
        $departureSeats = explode(',', $checkoutSession['departingSeats']);

        Log::info($request);
        Log::info($departureSeats);

        // i will need to get passenger details in the future 
        for ($i = 1; $i < count($departureSeats) + 1; $i++) {
            $formattedPassportExpiry = date("Y-m-d", strtotime($passengerSession["expiry-date-$i"]));
            $seat = (int)$departureSeats[$i-1];
            Log::info($seat);
            $passenger = \App\Models\Passenger::create([
                'booking_id' => $booking->id,
                'name' => $passengerSession["name-$i"],
                'seat_id' => $seat,
                'passport_number' => $passengerSession["passport-number-$i"],
                'passport_expiry_date' => $formattedPassportExpiry,
                'nationality' => $passengerSession["nationality-$i"],
                
            ]);

        }

        

        // remember to destory the session 

        Session::forget('checkout');
        Session::forget('passenger');


        // TODO: Create a new booking for the user 

        return view('success');

    }

    public function cancel() {
        
    }


}
