<x-front-layout>
    <!-- DISPLAY SCHEDULE -->
     <div class="flex justify-between items-center min-h-screen ">
        <div>
            <h1 class="text-8xl">Schedule</h1>
        </div>
        <div class="hidden lg:block pr-4 md:pr-12">
            <img src= "{{ asset('home.jpg') }}" alt="bus" class="w-96 h-96 object-cover rounded-lg shadow-lg">
        </div>
    </div>
    <!-- description section -->
    <div class="rounded-lg mt-8">
        <div>
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200 dark:bg-gray-700 text-left text-gray-600 dark:text-gray-300 font-semibold uppercase tracking-wider">1 Utama <-> Novena</th>
                        <th class="py-2 px-4 bg-gray-200 dark:bg-gray-700 text-left text-gray-600 dark:text-gray-300 font-semibold uppercase tracking-wider">Bangsar <-> Novena</th>
                        <th class="py-2 px-4 bg-gray-200 dark:bg-gray-700 text-left text-gray-600 dark:text-gray-300 font-semibold uppercase tracking-wider">Subang Parade <-> Star Vista</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">8.00AM</td>
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">7.30AM</td>
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">7.45AM</td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">10.00AM</td>
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">11.30AM</td>
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">9.45AM</td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">12.00 Noon</td>
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">2.30PM</td>
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">11.45AM</td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">3.00PM</td>
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">6.30PM</td>
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">2.45PM</td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">5.00PM</td>
                        <td></td>
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">4.45PM</td>
                    
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">7.00PM</td>
                        <td></td>
                        <td class="py-2 px-4 text-gray-700 dark:text-gray-300">6.45PM</td>
                    
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    
</x-front-layout>