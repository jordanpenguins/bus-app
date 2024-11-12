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
                        <!-- Iterate through all the depature times -->
                        {{-- @foreach ($seats as $seat) 
                            <h1>seats
                        
                        @endforeach --}}
                        <h2>8AM</h2>
                        <h2>10AM</h2>
                    </div>

                
            
                    <div class="flex flex-row justify-center items-center ">
                        <div class="grid grid-cols-2 gap-4 ">
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                            <div class="flex justify-center items-center"><img src= "{{ asset('seat.png') }}" alt="bus" class="h-10 w-10 object-cover"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    
    








</x-app-layout>

