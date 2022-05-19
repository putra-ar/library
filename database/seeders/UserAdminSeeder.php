<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\AdminUniversity;
use App\Models\User as ModelsUser;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            ModelsUser::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('admin'),
                'remember_token' => Str::random(60),
                'role'        => 'admin',
            ]);
    }
}
