<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'code_iso2' => 'BR',
                'code_iso3' => 'BRA',
                'name' => 'Brazil',
                'code_phone' => '+55',
                'lang' => 'pt-br',
            ]
        ];

        foreach($data as $reg)
        {
            Country::firstOrCreate($reg);
        }
    }
}
