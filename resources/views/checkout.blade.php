

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900">
                    <div>
                        <h1 class="font-bold text-2xl mb-4">Booking Summary</h1>
                        <!-- Destination -->
                        <div class="mb-2">
                            <span class="font-semibold">Route:</span> {{ $departureRoute->origin }} to {{ $departureRoute->destination }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Depart Time:</span> {{ $selectedDepartureTime }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Depart Date:</span> {{ $departureDate }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Passenger Quantity:</span> {{ $passengerQty }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Seats:</span> {{ $departingSeats }}
                        </div>

                        
                        

                        @if ($returnSchedule)
                            <!-- Add a divider -->
                            <hr class="my-4 border-gray-300 dark:border-gray-700">
                            <div class="mb-2">
                                <span class="font-semibold">Route:</span> {{ $returnRoute->origin }} to {{ $returnRoute ->destination }}
                            </div>
                            <div class="mb-2">
                                <span class="font-semibold">Return Time:</span> {{ $returnTime }}
                            </div>
                            <div class="mb-2">
                                <span class="font-semibold">Return Date:</span> {{ $returnDate }}
                            </div>
                            <div class="mb-2">
                                <span class="font-semibold">Passenger Quantity:</span> {{ $passengerQty }}
                            </div>
                        @endif

                        <div class="mb-2">
                            <span class="font-semibold">Total Price:</span> {{ $totalPrice }}
                        </div>


                        <!-- display the return information if it exist -->
                    </div>
                    <div>
                        <h1 class="font-bold text-2xl"> Payment Method: </h1>

                    </div>
                
                </div>
            </div>
        </div>
    </div>

    


</x-app-layout>