<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\WebhookHandled;
use Laravel\Cashier\Events\WebhookReceived;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;

class HandleStripeWebhook
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {   

        // need to handle cases where this function is being called multiple times

        Log::info($event->payload);
        if ($event->payload['type'] === 'checkout.session.completed') {

            // get the session from metadata

            // decode 
            $metadata = $event->payload['data']['object']['metadata'];

            $bookingDetailsJson = $metadata['booking_details'];
            $passengerDetailsJson = $metadata['passenger_details'];
            
            $numberOfPassengers = $metadata['number_of_passengers'];

            $bookingDetails = json_decode($bookingDetailsJson, true);
            $passengerDetails = json_decode($passengerDetailsJson);

            Log::info($bookingDetails);
            Log::info($passengerDetails);

            // create booking info 

            // create the booking information for departing schedule
            $booking = Booking::create([
                'user_id' => $bookingDetails['user_id'],
                'schedule_id' => $bookingDetails['schedule_id'],
                'total_price' => $bookingDetails['total_price'],
                'status' => $bookingDetails['status'],
            ]);

            // create passenger info
            foreach ($passengerDetails as $index => $passenger) {
                // Since $index starts from 0, we need to increment it by 1 to start from 1
                $i = $index + 1;
                $formattedPassportExpiry = date("Y-m-d", strtotime($passenger->{"passport-expiry-date-$i"}));
                \App\Models\Passenger::create([
                    'booking_id' => $booking->id,
                    'name' => $passenger->{"name-$i"},
                    'seat_id' => (int)$passenger->{"seat-id-$i"},
                    'passport_number' => $passenger->{"passport-number-$i"},
                    'passport_expiry_date' => $formattedPassportExpiry,
                    'nationality' => $passenger->{"nationality-$i"},
                ]);
            }

            // create the booking information if there is a return schedule booked by the passenger
            if (isset($bookingDetails['return_schedule_id'])) {
                $returnPassengerDetailsJson = $metadata['return_passenger_details'];
                $returnBooking = Booking::create([
                    'user_id' => $bookingDetails['user_id'],
                    'schedule_id' => $bookingDetails['return_schedule_id'],
                    'total_price' => $bookingDetails['total_price'],
                    'status' => $bookingDetails['status'],
                ]);

                $returnPassengerDetails = json_decode($returnPassengerDetailsJson);
                // create passenger info for return schedule
                foreach($returnPassengerDetails as $index => $passenger) {
                    // Since $index starts from 0, we need to increment it by 1 to start from 1
                    $i = $index + 1;
                    $formattedPassportExpiry = date("Y-m-d", strtotime($passenger->{"passport-expiry-date-$i"}));
                    \App\Models\Passenger::create([
                        'booking_id' => $returnBooking->id,
                        'name' => $passenger->{"name-$i"},
                        'seat_id' => (int)$passenger->{"seat-id-$i"},
                        'passport_number' => $passenger->{"passport-number-$i"},
                        'passport_expiry_date' => $formattedPassportExpiry,
                        'nationality' => $passenger->{"nationality-$i"},
                    ]);
                }


            }

            // Handle the incoming event...
            Log::info('Payment was successful!');
            
        }
    }
}
