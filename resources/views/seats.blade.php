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
                    <div class="font-bold mx-auto text-center">
                        {{ $departureRouteName -> origin }} to {{ $departureRouteName -> destination }}
                    </div>

                    <div class="mt-5 ">
                        <!-- Display the route title over here -->

                        {{ $firstDepartSchedule -> id }}


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
                    
                

                    <div class="flex flex-row justify-center items-center bg-slate-100 p-3 ">
                        <div class="grid grid-cols-3 gap-4 custom-grid-gap ">
                            @foreach ($departAvailability as $seat)
                                <div class="flex justify-center items-center">
                                    <label>
                                        <input  type="checkbox" name="seats[]" value="{{ $seat->id }}" class="hidden peer " {{ $seat->available ? '' : 'disabled' }}>
                                        <img src="{{ asset('seat.png') }}" alt="seat" class="h-10 w-10 object-cover peer-checked:border-blue-500 peer-checked:border-4 {{ $seat -> available ? '' : 'opacity-50 cursor-not-allowed'}}">
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class ="mt-5 p-3 border-red-700 bg-red-200 text-red-600 hidden" id="message-label"> </div>

                    <!-- This is so that if return date does not exist, then redirect them to the next checkout page -->
                    @if ($returnSchedule) 
                        <x-nav-link class="hidden" id="next-link" :href="route('search', [
                                'ticket_type' => request('ticket_type'),
                                'departure_date' => request('departure_date'),
                                'departure_route' => request('departure_route'),
                                'departure_schedule' => $firstDepartSchedule->id,
                                'departure_time' => $firstDepartSchedule->departure_time,
                                'selected_departure_time' => $firstDepartSchedule->departure_time,
                                'departing_seats' => implode(',', request('departing_seats', [])), 
                                'return_route' => request('return_route'),
                                'return_date' => request('return_date'),
                                'passenger_qty' => $passengerQty,
                                ])">
                                <!-- How do I put in the exisitng query strings parameters into the next following link -->
                                Next
                        </x-nav-link>

                    @else 
                        <x-nav-link  class="hidden" id="next-link" :href="route('checkout-page', [
                                'ticket_type' => request('ticket_type') ,
                                'departure_date' => request('departure_date'),
                                'departure_route' => $firstDepartSchedule ->id,
                                'departure_schedule' => $firstDepartSchedule ->id,
                                'departure_time' => $firstDepartSchedule->departure_time,
                                'selected_departure_time' => $firstDepartSchedule->departure_time,
                                'departing_seats' => implode(',', request('departing_seats', [])),
                                'return_route' => request('return_route'),
                                'return_date' => request('return_date'),
                                'passenger_qty' => $passengerQty,
                                ])">
                                <!-- How do I put in the exisitng query strings parameters into the next following link -->
                                Next
                        </x-nav-link>
                    @endif

                    

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            const nextLink = document.getElementById('next-link');
            const checkboxes = document.querySelectorAll('input[name="seats[]"]');
            var messageLabel = document.getElementById('message-label');
            var maxAllowed = {{ $passengerQty }} ;

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateLink);
            });

            // for every changes call the update link 
            function updateLink() {
                // get all the checkboxes, filter the seats which are checked, display the list of seats into an rray
                const selectedSeats = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);


                const url = new URL(nextLink.href);
                // concatenate selectedSeats into a string and insert them into the url
                url.searchParams.set('departing_seats', selectedSeats.join(','));

                nextLink.href = url.toString(); // convert the url into the string
            }

            checkboxes.forEach(function(checkbox){
                checkbox.addEventListener('change',function(){
                    var checkedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
                    if (checkedCount > maxAllowed) {
                        this.checked = false;
                    } 
                    
                    if (checkedCount === maxAllowed) {
                        nextLink.classList.remove('hidden');
                        messageLabel.classList.add('hidden');

                        checkboxes.forEach(function(otherCheckbox){
                            // disable other checkboxes if not checked to prevent other checkboxes from being selected
                            if (!otherCheckbox.checked) {
                                otherCheckbox.disabled = true;
                                
                            } 
                        });
                        
                    

                    } 
                    else {
                        nextLink.classList.add('hidden');
                        messageLabel.classList.remove('hidden');
                        
                        checkboxes.forEach(function(otherCheckbox){
                            otherCheckbox.disabled = false;
                        

                        });

                        // update the label to clear the message
                        updateLabel("Please select " + {{ $passengerQty }} + " passengers");

                    }
                });
            }) 

            function updateLabel(message) {
                messageLabel.textContent = message;

            }
        });
    </script>
</x-app-layout>

