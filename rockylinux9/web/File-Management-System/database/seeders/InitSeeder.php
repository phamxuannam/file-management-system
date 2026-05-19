<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    // Permissions
        
        $models = [
            'area', 'user', 'file'
        ];

        $actions = [
            'create', 'view', 'edit', 'delete'
        ];

        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$model}.{$action}",
                ]);
            }
        }

        $filePermissions = ['file.download','file.visibility'];
        foreach ($filePermissions as $filePermission) {
            Permission::firstOrCreate([
                'name' => $filePermission,
            ]);
        }

    // Roles

        $guestRole = Role::firstOrCreate([
            'name' => 'guest',
        ]);

        $normalUserRole = Role::firstOrCreate([
            'name' => 'normal_user',
        ]);

        $areaManagerRole = Role::firstOrCreate([
            'name' => 'area_manager',
        ]);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
        ]);

    // Assign Permissions for Roles

        $guestRole->syncPermissions([
            'file.view', 'file.download',
            'user.create'
        ]);

        $normalUserRole->syncPermissions([
            'file.create', 'file.view', 'file.edit', 'file.delete', 'file.download',
            'user.edit'
        ]);

        $areaManagerRole->syncPermissions([
            'file.create', 'file.view', 'file.edit', 'file.delete', 'file.download', 'file.visibility',
            'user.view', 'user.edit'
        ]);

        $superAdminRole->syncPermissions([
            Permission::all()
        ]);

    //account admin  & assign role
        $admin = User::firstOrCreate(
            [
                'email' => 'admin@gmail.com']
            ,[
                'fullname' => 'Super Admin',
                'password' => Hash::make('1234567890'),
                'area_id'  => 1
            ]
        );

        $admin->syncRoles([
            $superAdminRole,
        ]);
    }
}
