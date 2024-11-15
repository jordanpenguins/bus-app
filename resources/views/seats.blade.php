<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-slot name="header">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('Choose Seats') }}
                        </h2>
                    </x-slot>
                    <div>
                        <!-- Iterate through the schedule list to display other depature times that fall on the same date -->
                        @foreach ($schedule as $schedule)
                            <x-nav-link :href="route('search', [
                                'ticket_type' => request('ticket_type'),
                                'departure_date' => request('departure_date'),
                                'departure_route' => request('departure_route'),
                                'departure_time' => $schedule->departure_time,
                                'return_route' => request('return_route'),
                                'return_date' => request('return_date'),
                                'passenger_qty' => request('passenger_qty')
                                
                                ])">
                                <!-- How do I put in the exisitng query strings parameters into the next following link -->
                                {{ $schedule -> departure_time }}
                            </x-nav-link>
                        @endforeach

                    </div>

                    <div class="mt-5 mb-5">
                        Selected Time: {{ $firstDepartSchedule -> departure_time }}
                    </div>
            
                    <div class="flex flex-row justify-center items-center ">
                        <div class="grid grid-cols-3 gap-4 custom-grid-gap ">
                            @foreach ($departAvailability as $seat)
                                <div class="flex justify-center items-center">
                                    <label>
                                        <input type="checkbox" name="seats[]" value="{{ $seat->id }}" class="hidden peer {{ $seat->available ? '' : 'disabled'}}">
                                        <img src="{{ asset('seat.png') }}" alt="seat" class="unavailable-seat h-10 w-10 object-cover peer-checked:border-blue-500 peer-checked:border-4  ">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- I have to now check if the return date and time exist and then pass it back into the controller -->
                    <!-- This is so that if return date no longer exist, the next following page will be the checkout page -->
                </div>
            </div>
        </div>
    </div>

    
    








</x-app-layout>

