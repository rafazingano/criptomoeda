<?php

use Illuminate\Database\Seeder;
use App\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cities = [
        	[
        		'name' => 'Alvorada'
            ],
            [
        		'name' => 'Porto Alegre'
            ],
            [
        		'name' => 'Camaquã'
            ],
        ];
        foreach ($cities as $key => $value) {
        	City::create($value);
        }
    }
}
