<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\DataFactories\PermissionDataFactory;
use App\DataFactories\RoleDataFactory;
use App\DataFactories\UserDataFactory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Create a superadmin user
        $userDataFactory = new UserDataFactory();
        $userDataFactory->first_name = 'James Carlo';
        $userDataFactory->middle_name = 'Sebial';
        $userDataFactory->last_name = 'Luchavez';
        $userDataFactory->email = 'jamescarloluchavez@gmail.com';
        $userDataFactory->setPassword('Password123!');
        $user = $userDataFactory->firstOrCreate();

        // Create a spare user
        $userDataFactory->email = 'jsluchavez@outlook.com';
        $userDataFactory->firstOrCreate();

        // Create an superadmin role
        $roleDataFactory = new RoleDataFactory();
        $roleDataFactory->name = 'superadmin';
        $roleDataFactory->display_name = 'Superadmin';
        $roleDataFactory->description = 'Super Administrator role';
        $role = $roleDataFactory->firstOrCreate();

        // Create superadmin permissions

        // "Create Users" permission
        $permissionDataFactory = new PermissionDataFactory();
        $permissionDataFactory->name = 'create-users';
        $permissionDataFactory->display_name = 'Create Users';
        $permissionDataFactory->description = 'Create new users';
        $create_users = $permissionDataFactory->firstOrCreate();

        // "Create Roles" permission
        $permissionDataFactory->name = 'create-roles';
        $permissionDataFactory->display_name = 'Create Roles';
        $permissionDataFactory->description = 'Create new roles';
        $create_roles = $permissionDataFactory->firstOrCreate();

        // "Create Permissions" permission
        $permissionDataFactory->name = 'create-permissions';
        $permissionDataFactory->display_name = 'Create Permissions';
        $permissionDataFactory->description = 'Create new permissions';
        $create_permissions = $permissionDataFactory->firstOrCreate();

        // "View Telescope" permission
        $permissionDataFactory->name = 'view-telescope';
        $permissionDataFactory->display_name = 'View Telescope';
        $permissionDataFactory->description = 'View Laravel Telescope Dashboard';
        $view_telescope = $permissionDataFactory->firstOrCreate();

        // "View Laratrust" permission
        $permissionDataFactory->name = 'view-laratrust';
        $permissionDataFactory->display_name = 'View Laratrust';
        $permissionDataFactory->description = 'View Laratrust Dashboard';
        $view_laratrust = $permissionDataFactory->firstOrCreate();

        // "View Admin Dashboard" permission
        $permissionDataFactory->name = 'view-admin-dashboard';
        $permissionDataFactory->display_name = 'View Admin Dashboard';
        $permissionDataFactory->description = 'View Admin Dashboard';
        $view_admin_dashboard = $permissionDataFactory->firstOrCreate();

        // Assign Permissions to Superadmin
        if ($role instanceof Role) {
            $role->syncPermissions([
                $create_users,
                $create_roles,
                $create_permissions,
                $view_telescope,
                $view_laratrust,
                $view_admin_dashboard,
            ]);
        }

        // Assign Superadmin to User
        if ($user instanceof User) {
            $user->syncRolesWithoutDetaching([$role]);
        }
    }
}
