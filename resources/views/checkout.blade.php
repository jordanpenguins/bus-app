

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
                        <h1 class="font-bold text-2xl"> Passenger Details: </h1>

                        <div class="mt-5">
                            <form class="max-w-wd mx-auto" action = "{{ route('checkout') }}" method = "POST">
                                @csrf

                                @for ($i = 1; $i < $checkout['passengerQty'] + 1; $i++)
                                    <div class="mt-5">
                                        <div class = "mb-5">
                                            <h2>Passenger {{ $i }}</h2>
                                        </div>
                                        <div class="relative z-0 w-full mb-5 group">
                                            <input type="text" name="name-{{ $i }}" id="name-{{ $i }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                            <label for="name-{{ $i }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Full Name</label>
                                        </div>
                                        <div class="relative z-0 w-full mb-5 group">
                                            <input type="text" name="passport-number-{{ $i }}" id="passport-number-{{ $i }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                            <label for="passport-number-{{ $i }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Passport Number</label>
                                        </div>
                                        <div class="relative z-0 w-full mb-5 group">
                                            <input type="text" name="nationality-{{ $i }}" id="nationality-{{ $i }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                            <label for="nationality-{{ $i }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nationality</label>
                                        </div>
                                        <h2 class="mb-3"><b>Expiry</b> date </h2>
                                        <div class="relative max-w-sm mb-4">
                                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                                </svg>
                                            </div>
                                            <input datepicker id="expiry-date-{{ $i }}" name="expiry-date-{{ $i }}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                        </div>
                                       
                                    </div>
                                    <hr class="my-4 border-gray-300 dark:border-gray-700">
                                @endfor

                                <div class ="mt-5">
                                    <input type ="hidden" name="passenger_qty" value = "{{ $checkout['passengerQty']}}">
                                    <button type="submit" class="p-5 bg-lime-400 rounded">Checkout Now</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    


</x-app-layout>