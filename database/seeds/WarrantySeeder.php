<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarrantySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('machine')->get('serial_number')->each(function ($m) {
            factory(Warranty_model::class)->times(1)->create(['serial_number' => $m->serial_number]);
        });
    }
}