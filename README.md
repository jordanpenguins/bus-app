Sample Data

```

$bus = \App\Models\Bus::create([
    'name' => 'Express Bus',
    'number' => 'BUS123',
    'seats' => 50,
    'type' => 'Luxury'
]);

// Create a Route
$route = \App\Models\Route::create([
    'origin' => 'Bangsar',
    'destination' => 'Star Vista',
    'distance' => 120
]);

// Create a Schedule linked to the Bus and Route
$schedule = \App\Models\Schedule::create([
    'bus_id' => 1,
    'route_id' => 1,
    'departure_time' => '08:00:00',
    'arrival_time' => '12:00:00',
    'scheduled_date' => now()->addDays(1),
    'price' => 15.00
]);

// Create a seats

for ($i = 1; $i <= 27; $i++) {
    \App\Models\Seat::create([
        'bus_id' => 1,
        'seat_number' => $i,
        'status' => 'available',
    ]);
}


```