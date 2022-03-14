<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PositionsSeeder::class);
        $this->call(PrivilegesSeeder::class);
        $this->call(PositionsPrivilegesSeeder::class);
    }
}
