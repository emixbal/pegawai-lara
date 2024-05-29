<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil role "Admin" dan "User" dari database
        $adminRole = Role::where('name', 'Admin')->first();
        $userRole = Role::where('name', 'User')->first();

        // Tambahkan data pengguna dengan role "Admin"
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('aaaaaaaa'),
            'role_id' => $adminRole->id,
        ]);

        // Tambahkan data pengguna dengan role "User"
        User::create([
            'name' => 'Regular User',
            'email' => 'user@user.com',
            'password' => bcrypt('aaaaaaaa'),
            'role_id' => $userRole->id,
        ]);

        // Tambahkan data lainnya sesuai kebutuhan
    }
}
