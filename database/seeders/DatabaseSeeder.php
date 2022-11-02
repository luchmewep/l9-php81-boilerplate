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
        // Create a user
        $userDataFactory = new UserDataFactory();
        $userDataFactory->first_name = 'James Carlo';
        $userDataFactory->middle_name = 'Sebial';
        $userDataFactory->last_name = 'Luchavez';
        $userDataFactory->email = 'jamescarloluchavez@gmail.com';
        $userDataFactory->setPassword('Password123!');
        $user = $userDataFactory->firstOrCreate();

        // Create an superadmin role
        $roleDataFactory = new RoleDataFactory();
        $roleDataFactory->name = 'superadmin';
        $roleDataFactory->display_name = 'Superadmin';
        $roleDataFactory->description = 'Super Administrator role';
        $role = $roleDataFactory->firstOrCreate();

        // Create superadmin permissions

        // Create Roles
        $permissionDataFactory = new PermissionDataFactory();
        $permissionDataFactory->name = 'create-users';
        $permissionDataFactory->display_name = 'Create Users';
        $permissionDataFactory->description = 'Create new users';
        $create_users = $permissionDataFactory->firstOrCreate();

        // Create Roles
        $permissionDataFactory->name = 'create-roles';
        $permissionDataFactory->display_name = 'Create Roles';
        $permissionDataFactory->description = 'Create new roles';
        $create_roles = $permissionDataFactory->firstOrCreate();

        // Create Permissions
        $permissionDataFactory->name = 'create-permissions';
        $permissionDataFactory->display_name = 'Create Permissions';
        $permissionDataFactory->description = 'Create new permissions';
        $create_permissions = $permissionDataFactory->firstOrCreate();

        // Assign Permissions to Superadmin
        if ($role instanceof Role) {
            $role->syncPermissions([$create_users, $create_roles, $create_permissions]);
        }

        // Assign Superadmin to User
        if ($user instanceof User) {
            $user->syncRolesWithoutDetaching([$role]);
        }
    }
}
