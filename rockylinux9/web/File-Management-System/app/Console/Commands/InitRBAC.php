<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

#[Signature('app:init-r-b-a-c')]
#[Description('Command description')]
class InitRBAC extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {

        // chạy migration mới được thêm vào
        Artisan::call('migrate', [
        '--force' => true,
        ]);

        // clear permission cache
        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();

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

        $superAdminRole->syncPermissions(
            Permission::all()
        );

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