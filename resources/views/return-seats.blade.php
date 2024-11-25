<!-- resources/views/return-seats.blade.php -->
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-slot name="header">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('Choose Return Seats') }}
                        </h2>
                    </x-slot>
                    <div>
                        <!-- Iterate through the return schedule list to display other return times that fall on the same date -->
                        @foreach ($returnSchedule as $returnScheduleItem)
                            <x-nav-link :href="route('return-search', [
                                'ticket_type' => request('ticket_type'),
                                'departure_date' => request('departure_date'),
                                'departure_route' => request('departure_route'),
                                'departure_time' => request('departure_time'),
                                'return_route' => request('return_route'),
                                'return_date' => request('return_date'),
                                'selected_departure_time' => request('selected_departure_time'),
                                'return_time' => $returnScheduleItem-> departure_time,
                                'passenger_qty' => request('passenger_qty')
                            ])">
                                {{ $returnScheduleItem -> departure_time }}
                            </x-nav-link>
                        @endforeach
                    </div>

                    <div class="mt-5 mb-5">
                        Selected Return Time: {{ $firstReturnSchedule -> departure_time }}
                    </div>
            
                    <div class="flex flex-row justify-center items-center">
                        <div class="grid grid-cols-3 gap-4 custom-grid-gap">
                            @foreach ($returnAvailability as $seat)
                                <div class="flex justify-center items-center">
                                    <label>
                                        <input type="checkbox" name="return_seats[]" value="{{ $seat->id }}" class="hidden peer {{ $seat->available ? '' : 'disabled' }}">
                                        <img src="{{ asset('seat.png') }}" alt="seat" class="unavailable-seat h-10 w-10 object-cover peer-checked:border-blue-500 peer-checked:border-4 {{ $seat->available ? '' : 'unavailable-seat' }}">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- next page will bring you to the checkout page for the order summary --> 
                    <!-- TODO -->
                    <x-nav-link :href="route('checkout', [
                                'ticket_type' => request('ticket_type'),
                                'departure_date' => request('departure_date'),
                                'departure_route' => request('departure_route'),
                                'departure_time' => $firstDepartSchedule->departure_time,
                                'selected_departure_time' => $firstDepartSchedule->departure_time,
                                'return_time' => $firstReturnSchedule -> departure_time,
                                'return_route' => request('return_route'),
                                'return_date' => request('return_date'),
                                'passenger_qty' => request('passenger_qty'),
                                ])">
                                <!-- How do I put in the exisitng query strings parameters into the next following link -->
                                Next
                        </x-nav-link>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>