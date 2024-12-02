<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Purchase Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="max-w-sm" action="{{ route('search') }}" method ="GET" >
                        <h2 class="mb-3"> Select ticket type </h2>
                        <div class="flex items-center mb-4">
                            <input checked id="one-way-radio" type="radio" value="one_way" name="ticket_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="one-way-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">One-Way</label>
                        </div>
                        <div class="flex items-center mb-4">
                            <input id="return-radio" type="radio" value="two_way" name="ticket_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="return-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                        </div>
                        <h2 class="mb-3"> Select <b>Departure</b> date </h2>

                        <div class="relative max-w-sm mb-4">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input datepicker id="departure-datepicker" name="departure_date" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" required>
                        </div>

                        <h2 class="mb-3"> Select <b>Departure</b> Route </h2>
                        <div class="relative max-w-sm mb-4">
                            <label for="routes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                            <select id="routes" required name="departure_route" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" selected>Choose a route</option>
                                @foreach ($routes as $route) 
                                    <option value="{{ $route -> id }}">{{ $route -> origin }} to {{ $route -> destination }} </option> 
                                @endforeach 
                            </select>
                        </div>

                        <div id="return-section" class="hidden">
                            <h2 class="mb-3"> Select  <b>Return</b> date </h2>
                            <div class="relative max-w-sm mb-4">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input datepicker id="return-datepicker" name="return_date" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                            </div>

                            <h2 class="mb-3"> Select <b>Return</b> Route </h2>
                            <div class="relative max-w-sm mb-4">
                                <label for="routes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                                <select id="routes" name="return_route" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value = "" selected>Choose a route</option>
                                    @foreach ($routes as $route) 
                                        <option value="{{ $route -> id }}">{{ $route -> origin }} to {{ $route -> destination }} </option> 
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Number of Passengers:</label>
                            <div class="relative flex items-center max-w-[8rem]">
                                <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                    </svg>
                                </button>
                                <input type="text" id="quantity-input" name="passenger_qty" data-input-counter  aria-describedby="helper-text-explanation" data-input-counter-min="1" data-input-counter-max="4" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0"required />
                                <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                    </svg>
                                </button>
                            </div>
                            <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Please select a maximum of 4</p>
                        </div>

                        <!-- submit button -->
                        <button type="submit" class="mt-4 px-3 py-2  bg-blue-600 rounded text-white" id="submit-button">Search</button>
                        
                        


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const oneWayRadio = document.getElementById('one-way-radio');
        const returnRadio = document.getElementById('return-radio');
        const returnSection = document.getElementById('return-section');

        oneWayRadio.addEventListener('change', function () {
            returnSection.classList.add('hidden');
        });

        returnRadio.addEventListener('change', function () {
            returnSection.classList.remove('hidden');
        });

        // Initialize the state based on the default selected radio button
        if (returnRadio.checked) {
            returnSection.classList.remove('hidden');
        } else {
            returnSection.classList.add('hidden');
        }

    });
</script>
