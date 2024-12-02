<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function index() {

        Log::info("index");
        
    
    }

    public function checkout(Request $request) {


        $stripePriceId = 'price_1QRAnNHrbBfQ3SJwye8gCgKf';
 
        $quantity = 1;
     
        return $request->user()->checkout([$stripePriceId => $quantity], [
            'success_url' => route('checkout-success'),
            'cancel_url' => route('checkout-cancel'),
        ]);


    }

    public function success() {
        Log::info("Success");
        // when successful create a new booking for the user 

        


        // TODO: Create a new booking for the user 

    }

    public function cancel() {
        
    }


}
