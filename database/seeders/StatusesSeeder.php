<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            ['name' => 'Очакване за дизайн', 'slug' => 'print'],
            ['name' => 'Очакване за печат', 'slug' => 'print'],
            ['name' => 'Одобрение на дизайн', 'slug' => 'office'],
            ['name' => 'Designer', 'slug' => 'designer'],
            ['name' => 'Printer', 'slug' => 'printer'],
            ['name' => 'Довършителни(Широкоформатен)', 'slug' => 'lastprint'],
            ['name' => 'Довършителни(Дигитални)', 'slug' => 'lastdesign'],
            ['name' => '2 група', 'installation_team' => 'lastdesign'],
            ['name' => '3 група', 'installation_team' => 'lastdesign'],
            ['name' => '4 група', 'installation_team' => 'lastdesign'],
            ['name' => '5 група', 'installation_team' => 'lastdesign'],
        ]);
    }
}
