<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WebSetting;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'role-list', 'description' => 'Melihat data Peran'],
            ['name' => 'role-create', 'description' => 'Menambah data Peran'],
            ['name' => 'role-edit', 'description' => 'Mengubah data Peran'],
            ['name' => 'role-delete', 'description' => 'Menghapus data Peran'],
            ['name' => 'role-download', 'description' => 'Mengunduh data Peran'],
            ['name' => 'user-list', 'description' => 'Melihat data Pengguna'],
            ['name' => 'user-create', 'description' => 'Menambah data Pengguna'],
            ['name' => 'user-edit', 'description' => 'Mengubah data Pengguna'],
            ['name' => 'user-delete', 'description' => 'Menghapus data Pengguna'],
            ['name' => 'user-download', 'description' => 'Mengunduh data Pengguna'],
            ['name' => 'renstra-list', 'description' => 'Melihat data Renstra Kadis'],
            ['name' => 'renstra-create', 'description' => 'Menambah data Renstra Kadis'],
            ['name' => 'renstra-edit', 'description' => 'Mengubah data Renstra Kadis'],
            ['name' => 'renstra-delete', 'description' => 'Menghapus data Renstra Kadis'],
            ['name' => 'renstra-download', 'description' => 'Mengunduh data Renstra Kadis'],
            ['name' => 'activity-list', 'description' => 'Melihat data Aktivitas Pengguna'],
            ['name' => 'activity-download', 'description' => 'Mengunduh data Aktivitas Pengguna'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'description' => $permission['description']
            ]);
        }

        $user = User::create([
            'name' => 'Lord Daud',
            'email' => 'sonychandmaulana@gmail.com',
            'password' => bcrypt('12344321'),
            'email_verified_at' => now(),
        ]);

        $role = Role::create(['name' => 'Super Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        WebSetting::create([
            'web_default_user_role' => 1
        ]);

        for ($i = 0; $i <= 10; $i++) {
            $faker = Faker::create();
            Role::create([
                'name' => $faker->name,
                'guard_name' => 'web',
            ]);
        }

        User::factory()->count(22)->create();
    }
}
