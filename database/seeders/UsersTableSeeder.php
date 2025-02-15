<?php

namespace Database\Seeders;

use App\Models\user;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrador',
                'email' => 'admin@cumi.com',
                'password' => '$2y$10$cXVLvs9JkKIq2OtLJni8jeJf/5wVsmiP2nkD4YrkgsnSa5Opmbkf.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Persona',
                'email' => 'persona@cumi.com',
                'password' => '$2y$10$cXVLvs9JkKIq2OtLJni8jeJf/5wVsmiP2nkD4YrkgsnSa5Opmbkf.',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);
        $adminUsers = User::whereIn('id', [1])->get();

        foreach ($adminUsers as $adminUser) {
            $adminUser->assignRole('Admin');
        }
    }
}
