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
            'manage cars',/* untuk mengelolah data kategori */
            'manage rentals',/* untuk mengelolah data kategori */
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
            // 'manage cars',/* untuk mengelolah data kategori */
            'manage rentals',/* untuk mengelolah data kategori */

        ];

        $adminRole->syncPermissions($adminPermissions);


        $userRole = Role::firstOrCreate([
            'name' => 'user'
        ]);

        $userPermissions = [
            // 'manage cars',/* untuk mengelolah data kategori */
            'manage rentals',/* untuk mengelolah data kategori */

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
            'address' => 'Lauwo, Kec. Buntulia, Kabupaten Pohuwato, Gorontalo',
            'phone_number' => '085340000000',
            // 'avatar' => 'images/default-avatar.png',
            'driver_license' => 'B 1234567',
            'password' => bcrypt('asdfasdf')
        ]);
        $user->assignRole($superAdminRole);
    }
}
