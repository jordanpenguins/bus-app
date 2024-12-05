

<x-app-layout>
    @php
        $checkout = Session::get('checkout');
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900">
                    <div>
                        <h1 class="font-bold text-2xl mb-4">Booking Summary</h1>
                        <!-- Destination -->
                        <div class="mb-2">
                            <span class="font-semibold">Route:</span> {{ $checkout['departureRoute'] -> origin }} to {{ $checkout['departureRoute']->destination }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Depart Time:</span> {{ $checkout['departureTime']  }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Depart Date:</span> {{ $checkout['departureDate']  }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Passenger Quantity:</span> {{ $checkout['passengerQty']  }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Seats:</span> {{ $checkout['departingSeats'] }}
                        </div>



                        @if ($checkout['returnSchedule'])
                            <!-- Add a divider -->
                            <hr class="my-4 border-gray-300 dark:border-gray-700">
                            <div class="mb-2">
                                <span class="font-semibold">Route:</span> {{ $checkout['returnRoute']->origin }} to {{ $checkout['returnRoute'] ->destination }}
                            </div>
                            <div class="mb-2">
                                <span class="font-semibold">Return Time:</span> {{ $checkout['returnTime'] }}
                            </div>
                            <div class="mb-2">
                                <span class="font-semibold">Return Date:</span> {{ $checkout['returnDate']}}
                            </div>
                            <div class="mb-2">
                                <span class="font-semibold">Passenger Quantity:</span> {{ $checkout['passengerQty']}}
                            </div>
                            
                            <div class="mb-2">
                                <span class="font-semibold">Returning Seats:</span> {{ $checkout['returningSeats'] }}
                            </div>
                        @endif

                        <hr class="my-4 border-gray-300 dark:border-gray-700">

                        <div class="mb-2">
                            <span class="font-semibold">Total Price:</span> {{ $checkout['totalPrice'] }}
                        </div>


                        <!-- display the return information if it exist -->
                    </div>
                    <div>
                        <h1 class="font-bold text-2xl"> Payment Method: </h1>

                    
                        <div class ="mt-5">
                            <form action = "{{ route('checkout') }}" method = "POST">
                                @csrf
                                <input type ="hidden" name="passenger_qty" value = "{{ $checkout['passengerQty']}}">
                                <button type="submit" href="{{ route('checkout') }}" class="p-5 bg-lime-400 rounded">Checkout Now</a>
                            </form>
                        </div>

                    </div>
                
                </div>
            </div>
        </div>
    </div>

    


</x-app-layout>