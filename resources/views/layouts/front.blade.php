<!-- File: resources/views/layouts/welcome.blade.php -->
<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>{{ config('app.name', 'Laravel') }}</title>

            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

            <!-- Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>
        <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div x-data="{ open: false}" class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-4 lg:grid-cols-2 bg-lime-500 w-full fixed top-0 left-0">
                        <div class="flex lg:justify-start lg:col-start-1 pl-6">
                            <a href="/">
                                <img src="{{ asset('logo.jpg') }}" alt="Logo" style="width: 100px; height: 50px; object-fit: cover;">
                            </a>
                        </div>
                        <!-- hamburger menu -->
                        <div class="flex justify-end lg:hidden pr-6">
                            <button @click="open = !open" class="text-blue-900 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                </svg>
                            </button>
                        </div>


                        <!-- Main navigation for larger screens -->
                        <nav class="hidden lg:flex flex-1 justify-end whitespace-nowrap font-bold pr-6">
                            <a href="" class="rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Home</a>
                            <a href="" class="rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">About Us</a>
                            <a href="" class="rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Services</a>
                            <a href="" class="rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Schedule & Fare</a>
                            <a href="" class="rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Career</a>
                            <a href="" class="rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Contact Us</a>
                            <a href="" class="rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Sitemap</a>
                        </nav>

                        <!-- Hamburger menu navigation for smaller screens -->
                        <nav :class="{'block': open, 'hidden': !open}" class="hidden flex-col font-bold lg:hidden w-full bg-lime-500">
                            <a href="" class="block rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Home</a>
                            <a href="" class="block rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">About Us</a>
                            <a href="" class="block rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Services</a>
                            <a href="" class="block rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Schedule & Fare</a>
                            <a href="" class="block rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Career</a>
                            <a href="" class="block rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Contact Us</a>
                            <a href="" class="block rounded-md px-3 py-2 text-blue-900 ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Sitemap</a>
                        </nav>
                    </header>
                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
