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

                    <div class="font-bold mx-auto text-center">
                        {{ $returnRouteName -> origin }} to {{ $returnRouteName -> destination }}
                    </div>


                    <div class = "mt-5">

                        {{ $firstReturnSchedule -> id }}


                        <!-- Iterate through the return schedule list to display other return times that fall on the same date -->
                        @foreach ($returnSchedule as $returnScheduleItem)
                            <x-nav-link :href="route('return-search', [
                                'ticket_type' => request('ticket_type'),
                                'departure_date' => request('departure_date'),
                                'departure_route' => request('departure_route'),
                                'departing_seats' => request('departing_seats'),
                                'departure_time' => request('departure_time'),
                                'return_route' => request('return_route'),
                                'return_date' => request('return_date'),
                                'selected_departure_time' => request('selected_departure_time'),
                                'return_time' => $returnScheduleItem->departure_time,
                                'passenger_qty' => request('passenger_qty')
                            ])">
                                {{ $returnScheduleItem->departure_time }}
                            </x-nav-link>
                        @endforeach
                    </div>

                    <div class="mt-5 mb-5">
                        Selected Return Time: {{ $firstReturnSchedule->departure_time }}
                    </div>
            
                    <div class="flex flex-row justify-center items-center bg-slate-100 p-3">
                        <div class="grid grid-cols-3 gap-4 custom-grid-gap">
                            @foreach ($returnAvailability as $seat)
                                <div class="flex justify-center items-center">
                                    <label>
                                        <input type="checkbox" name="return_seats[]" value="{{ $seat->id }}" class="hidden peer {{ $seat->available ? '' : 'disabled' }}">
                                        <img src="{{ asset('seat.png') }}" alt="seat" class=" h-10 w-10 object-cover peer-checked:border-blue-500 peer-checked:border-4 {{ $seat->available ? '' : 'opacity-50 cursor-not-allowed' }}">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-5 p-3 border-red-700 bg-red-200 text-red-600 hidden" id="message-label"></div>

                    <!-- next page will bring you to the checkout page for the order summary --> 
                    <x-nav-link class="hidden" id="next-link" :href="route('checkout-page', [
                        'ticket_type' => request('ticket_type'),
                        'departure_date' => request('departure_date'),
                        'departure_route' => request('departure_route'),
                        'departure_schedule' =>$firstDepartSchedule->id,
                        'return_schedule' => $firstReturnSchedule->id,
                        'departure_time' => $firstDepartSchedule->departure_time,
                        'departing_seats' => request('departing_seats'), 
                        'returning_seats' => implode(',', request('returning_seats', [])),
                        'selected_departure_time' => $firstDepartSchedule->departure_time,
                        'return_time' => $firstReturnSchedule->departure_time,
                        'return_route' => request('return_route'),
                        'return_date' => request('return_date'),
                        'passenger_qty' => $passengerQty,
                    ])">
                        Next
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nextLink = document.getElementById('next-link');
            const checkboxes = document.querySelectorAll('input[name="return_seats[]"]');
            const messageLabel = document.getElementById('message-label');
            const maxAllowed = {{ $passengerQty }};

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateLink);
            });

            function updateLink() {
                const selectedSeats = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                const url = new URL(nextLink.href);
                url.searchParams.set('returning_seats', selectedSeats.join(','));
                nextLink.href = url.toString();
            }

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const checkedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
                    if (checkedCount > maxAllowed) {
                        this.checked = false;
                    }

                    if (checkedCount === maxAllowed) {
                        nextLink.classList.remove('hidden');
                        messageLabel.classList.add('hidden');
                        checkboxes.forEach(function(otherCheckbox) {
                            if (!otherCheckbox.checked) {
                                otherCheckbox.disabled = true;
                            }
                        });
                    } else {
                        nextLink.classList.add('hidden');
                        messageLabel.classList.remove('hidden');
                        checkboxes.forEach(function(otherCheckbox) {
                            otherCheckbox.disabled = false;
                        });
                        updateLabel("Please select " + {{ $passengerQty }} + " passengers");
                    }
                });
            });

            function updateLabel(message) {
                messageLabel.textContent = message;
            }
           
        });
    </script>
</x-app-layout>