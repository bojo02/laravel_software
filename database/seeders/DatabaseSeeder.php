<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
            ['name' => 'Монтажна група', 'slug' => 'installation_team'],
            ['name' => 'Администратор', 'slug' => 'admin'],
        ]);
        DB::table('statuses')->insert([
            ['name' => 'Очакване за дизайн', 'slug' => 'waiting_design'],
            ['name' => 'Очакване за печат', 'slug' => 'waiting_printer'],
            ['name' => 'Одобрение на дизайн', 'slug' => 'design_review'],
            ['name' => 'Доработки от дизайнер', 'slug' => 'design_confirm'],
            ['name' => 'Довършителни(Дигитални)', 'slug' => 'lastdesign'],
            ['name' => 'Довършителни(Широкоформатен)', 'slug' => 'lastprint'],
            ['name' => 'Предаване / Монтаж', 'slug' => 'install_client'],
            ['name' => 'Монтажна Група', 'slug' => 'invoice'],
            ['name' => 'Фактуриране', 'slug' => 'payment'],
            ['name' => 'Приключена', 'slug' => 'done'],
        ]);
        DB::table('formats')->insert([
            ['name' => 'Дигитален', 'slug' => 'digital'],
            ['name' => 'Широкоформатен', 'slug' => 'print'],
        ]);
        DB::table('payments')->insert([
            ['name' => 'По банка с фактура', 'slug' => 'bank_cash'],
            ['name' => 'На каса с фактура', 'slug' => 'bank'],
            ['name' => 'На каса без фактура', 'slug' => 'cash'],
        ]);
        DB::table('deliveries')->insert([
            ['name' => 'Монтажна група', 'slug' => 'installation_team'],
            ['name' => 'Предаване на клиент', 'slug' => 'client'],
        ]);
        DB::table('users')->insert([
            ['name' => 'Admin admin', 'email' => 'admin@admin.com', 'password' => Hash::make('admin1234'), 'role_id' => '9'],
        ]);
    }
}
