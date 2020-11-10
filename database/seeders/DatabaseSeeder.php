<?php

use Illuminate\Database\Seeder;
use Database\Seeders\InstrumentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(InstrumentSeeder::class);//пока не вставил стр 4. сидер не видел. в ларе 5-7 все видел и так ?
    }
}
