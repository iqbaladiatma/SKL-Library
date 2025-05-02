<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $admin = User::factory()->create([
            'name' => 'Mimin',
            'email' => 'mimin@mimin.com',
            'password' => bcrypt('12345678'),
            'is_admin' => 1,
        ]);
        $admin->assignRole('admin');
    }
}
