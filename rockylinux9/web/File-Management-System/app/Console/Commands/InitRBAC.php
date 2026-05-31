<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

#[Signature('app:init-rbac')]
#[Description('Command description')]
class InitRBAC extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        // RUN php artisan app:init-RBAC

        //chạy migrate
        Artisan::call('migrate', ['--force' => true]);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate(); 

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $models = [
            'area',
            'user',
            'file'
        ];

        $actions = [
            'create',
            'view',
            'edit',
            'delete'
        ];

        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$model}.{$action}",
                ]);
            }
        }

        $filePermissions = ['file.download', 'file.visibility'];
        foreach ($filePermissions as $filePermission) {
            Permission::firstOrCreate([
                'name' => $filePermission,
            ]);
        }

        // Roles

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

        $normalUserRole->syncPermissions([
            'file.create',
            'file.view',
            'file.edit',
            'file.delete',
            'file.download',
        ]);

        $areaManagerRole->syncPermissions([
            'file.create',
            'file.view',
            'file.edit',
            'file.delete',
            'file.download',
            'file.visibility',
            'user.view',
        ]);

        $superAdminRole->syncPermissions(
            Permission::all()
        );

        //account admin  & assign role

        $admin = User::firstOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'fullname' => 'Super Admin',
                'password' => Hash::make('1234567890'),
                'area_id'    => null
            ]
        );

        $admin->syncRoles([
            $superAdminRole,
        ]);
    }
}
