<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'name' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'username' => Str::random(10),
            'password' => Hash::make('password'),
            'verified' => 'F',
            'birthday' => '2000-10-11',
        ]);

        DB::table('sheets')->insert([
            'name' => Str::random(10),
            'clients_id' => 1,
            'description' => Str::random(10),
            'key' => Str::random(10),
            'main_genre' => Str::random(10),
            'views' => 0,
            'downloads' => 0,
        ]);

        DB::table('sheet_instruments')->insert([
            'sheets_id' => 1,
            'instrument' => Str::random(10),
            'effects' => Str::random(10).'@gmail.com',
            'pdf' => 'pdf/prueba.pdf',
        ]);

        DB::table('comments')->insert([
            'clients_id' => 1,
            'sheets_id' => 1,
            'date_time' => Carbon::now(),
            'description' => Str::random(10),
        ]);
    }
}
