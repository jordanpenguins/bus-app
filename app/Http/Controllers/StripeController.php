<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Cashier\Events\WebhookReceived;
use Stripe\Charge;

class StripeController extends Controller
{
    public function index() {

        Log::info("index");
        
    
    }

    public function checkout(Request $request) {

        // put passengers details into the session
        Log::info($request);
        $metadata = [];
        $stripePriceId = 'price_1QRAnNHrbBfQ3SJwye8gCgKf';

        // merge the existing 
        $passenger = $request -> all();
        Session::put("passenger",$passenger);

        $checkoutSession = Session::get('checkout');
        $passengerSession = Session::get('passenger');

        // create the receipt

        // TO DO 

        // hardcode passenger details into the booking

        // Departure Booking details
        $bookingDetails = [
            'user_id' => $request->user()->id,
            'schedule_id' => $checkoutSession['departureRoute']->id,
            'total_price' => (float)$checkoutSession['price'],
            'status' => 'confirmed',
        ];

        
        // if return schedule exists, create a booking session for that as well
        if (isset($checkoutSession['returnRoute'])) {
            // merge the return schedule id into the booking details since other information remains the same anyways
            $bookingDetails['return_schedule_id'] = $checkoutSession['returnRoute']->id; 
            // convert return seats into an array
            $returnSeats = explode(',', $checkoutSession['returningSeats']);
            $returnPassengerDetails = [];

            for ($i = 1; $i < count($returnSeats) + 1; $i++) {
                $formattedPassportExpiry = date("Y-m-d", strtotime($passengerSession["expiry-date-$i"]));
                $seat = (int)$returnSeats[$i-1];
                $returnPassengerDetails[] = (object)[
                    "name-$i" => $passengerSession["name-$i"],
                    "seat-id-$i" => $seat,
                    "passport-number-$i" => $passengerSession["passport-number-$i"],
                    "passport-expiry-date-$i" => $formattedPassportExpiry,
                    "nationality-$i" => $passengerSession["nationality-$i"],
                ];
            }

            // encode return passenger details to JSON
            $returnPassengerDetailsJson = json_encode($returnPassengerDetails);

            // merge into the metadata
            $metadata = [
                'return_passenger_details' => $returnPassengerDetailsJson,
            ];

            // temporary hardcode the price id 
            $stripePriceId = 'price_1QRQgJHrbBfQ3SJwCq21l7JP';


        }

        // convert depature seats into an array
        $departureSeats = explode(',', $checkoutSession['departingSeats']);
        $passengerDetails = [];

        // i will need to get passenger details in the future 
        for ($i = 1; $i < count($departureSeats) + 1; $i++) {
            $formattedPassportExpiry = date("Y-m-d", strtotime($passengerSession["expiry-date-$i"]));
            $seat = (int)$departureSeats[$i-1];
            $passengerDetails[] = (object)[
                "name-$i" => $passengerSession["name-$i"],
                "seat-id-$i" => $seat,
                "passport-number-$i" => $passengerSession["passport-number-$i"],
                "passport-expiry-date-$i" => $formattedPassportExpiry,
                "nationality-$i" => $passengerSession["nationality-$i"],
            ];

        }

        // // encod boooking and passenger details to JSON
        $bookingDetailsJson = json_encode($bookingDetails);
        $passengerDetailsJson = json_encode($passengerDetails);

        
        $quantity = (int)$request -> passenger_qty;
         // merge into the metadata
         $metadata = array_merge($metadata, [
            'booking_details' => $bookingDetailsJson,
            'user_id' => $request->user()->id,
            'passenger_details' => $passengerDetailsJson,
            'number_of_passengers' => $quantity,
        ]);


        Log::info($metadata);


        return $request->user()->checkout([$stripePriceId => $quantity], [
            'success_url' => route('checkout-success'),
            'cancel_url' => route('checkout-cancel'),
            'metadata' => $metadata,
        ]);

    }

    public function success(Request $request) {
        // when successful create a new booking for the user

        if (!Session::has('checkout') || !Session::has('passenger')){
            return;
        }
        
        // remember to destory the session 

        Session::forget('checkout');
        Session::forget('passenger');
        
        
        return view('success');

    }

    public function cancel() {

        // remove the passenger and update the booking details to incomplete
        
    }

    


}
