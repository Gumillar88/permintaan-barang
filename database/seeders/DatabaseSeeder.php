<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!User::where('email', 'mail@mail.com')->exists()) {
            User::create([
                'name' => 'Gumilar L Wijayadi',
                'email' => 'mail@mail.com',
                'password' => Hash::make('12345678'),
            ]);
        }

        $this->call([
            ItemSeeder::class,
        ]);

        DB::table('departments')->insert([
            ['name' => 'Keuangan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HRD', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'IT', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
