<?php

use EmployeeDirectory\Entity\Title;
use Illuminate\Database\Seeder;

class TitleTableSeed extends Seeder
{
    public const TITLES = [
        'Level One',
        'Level Two',
        'Level Three',
        'Level Four',
        'Level Five'
    ];

    public function run(): void
    {
        DB::table('titles')->delete();

        foreach (self::TITLES as $title) {
            Title::create([
                'name' => $title,
            ]);
        }
    }
}
