<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pastikan baris ini ada dan tidak di-comment
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
