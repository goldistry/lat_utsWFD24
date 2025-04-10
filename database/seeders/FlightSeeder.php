<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Support\Str;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Flight::insert([
            [
                'flight_code' => Str::upper(Str::random(2)) . rand(100, 999),
                'origin' => 'SUB',
                'destination' => 'CGK',
                'departure_time' => $now->copy()->addHours(2),
                'arrival_time' => $now->copy()->addHours(3),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'flight_code' => Str::upper(Str::random(2)) . rand(100, 999),
                'origin' => 'DPS',
                'destination' => 'SUB',
                'departure_time' => $now->copy()->addHours(4),
                'arrival_time' => $now->copy()->addHours(5)->addMinutes(30),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'flight_code' => Str::upper(Str::random(2)) . rand(100, 999),
                'origin' => 'CGK',
                'destination' => 'DPS',
                'departure_time' => $now->copy()->addDays(1)->addHours(1),
                'arrival_time' => $now->copy()->addDays(1)->addHours(3),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'flight_code' => Str::upper(Str::random(2)) . rand(100, 999),
                'origin' => 'MED',
                'destination' => 'CGK',
                'departure_time' => $now->copy()->addDays(1)->addHours(5),
                'arrival_time' => $now->copy()->addDays(1)->addHours(7),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'flight_code' => Str::upper(Str::random(2)) . rand(100, 999),
                'origin' => 'JOG',
                'destination' => 'SUB',
                'departure_time' => $now->copy()->addDays(2)->addHours(3),
                'arrival_time' => $now->copy()->addDays(2)->addHours(4),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Anda bisa menambahkan lebih banyak data di sini jika diperlukan
        ]);
    }
}
