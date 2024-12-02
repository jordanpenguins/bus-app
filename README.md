Sample Data

```



$bus = \App\Models\Bus::create([
    'name' => 'Express Bus',
    'number' => 'BUS123',
    'seats' => 50,
    'type' => 'Luxury'
]);

// Create a Route

## Bangsar to Star Vista

$route = \App\Models\Route::create([
    'origin' => 'Bangsar',
    'destination' => 'Star Vista',
    'distance' => 120
]);


$route = \App\Models\Route::create([
    'origin' => 'Star Vista',
    'destination' => 'Bangsar',
    'distance' => 120
]);

## 1 Utama to Novena

$route = \App\Models\Route::create([
    'origin' => '1 Utama',
    'destination' => 'Novena',
    'distance' => 120
]);

$route = \App\Models\Route::create([
    'origin' => 'Novena',
    'destination' => '1 Utama',
    'distance' => 120
]);

## Subang Parade to Star Vista

$route = \App\Models\Route::create([
    'origin' => 'Subang Parade',
    'destination' => 'Star Vista',
    'distance' => 120
]);

$route = \App\Models\Route::create([
    'origin' => 'Star Vista',
    'destination' => 'Subang Parade',
    'distance' => 120
]);



// Create a Schedule linked to the Bus and Route
$schedule = \App\Models\Schedule::create([
    'bus_id' => 1,
    'route_id' => 1,
    'departure_time' => '18:00:00',
    'arrival_time' => '22:00:00',
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