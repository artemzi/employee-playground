<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
         $this->call(TitleTableSeed::class);
         $this->call(EmployeeTableSeed::class);
    }
}
