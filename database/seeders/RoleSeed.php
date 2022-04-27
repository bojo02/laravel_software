<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Sales Manager', 'slug' => 'sales'],
            ['name' => 'Account Manager', 'slug' => 'account'],
            ['name' => 'Office Manager', 'slug' => 'office'],
            ['name' => 'Designer', 'slug' => 'designer'],
            ['name' => 'Printer', 'slug' => 'printer'],
            ['name' => 'Довършителни(Широкоформатен)', 'slug' => 'lastprint'],
            ['name' => 'Довършителни(Дигитални)', 'slug' => 'lastdesign'],
            ['name' => 'Монтажна група', 'installation_team' => 'lastdesign'],
        ]);
    }
}