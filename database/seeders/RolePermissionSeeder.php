<?php



namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // membuat kumpulan permision menggunakan array
        $permissions = [
            'manage categories',/* untuk mengelolah data kategori */
            'manage manajemen',/* untuk mengelolah data kategori */
        ];

        foreach($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        $adminRole = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        $adminPermissions = [
            // 'manage userall',
            'manage manajemen',

        ];

        $adminRole->syncPermissions($adminPermissions);


        $userRole = Role::firstOrCreate([
            'name' => 'user'
        ]);

        $userPermissions = [
            'manage manajemen',/* untuk membuat beberapa pekerjaan  */

        ];

        $userRole->syncPermissions($userPermissions);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);
        // $superAdminRole = Role::firstOrCreate([
        //     'name' => 'super_admin'
        // ]);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'muhradifansyah@gmail.com',
            // 'occupation' => 'Superadmin',
            // 'experience' => 100,
            // 'avatar' => 'images/default-avatar.png',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($superAdminRole);
    }
}
