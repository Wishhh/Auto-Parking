<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ParkingCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parking_cards')->insert([
            [
                'entering_date' => Carbon::now()->subDays(3)->toDateString(),
                'car_number' => 'ABC123',
                'car_model' => 'Toyota Camry',
                'car_size' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'entering_date' => Carbon::now()->subDays(1)->toDateString(),
                'car_number' => 'XYZ789',
                'car_model' => 'Honda Civic',
                'car_size' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
