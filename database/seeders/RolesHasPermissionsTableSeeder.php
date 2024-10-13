<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define role-permission mappings
        $rolePermissions = [
            'Admin' => [
                'Access Air Availability',
                'Access Hotel Information',
                'Access Fare Details',
                'View PNR',
                'Edit PNR',
                'Access Destinations'
            ],
            'Unrestricted' => [
                'Access Air Availability',
                'Access Hotel Information',
                'Access Fare Details',
                'View PNR',
                'Edit PNR',
                'Access Destinations',
                'Access User List',
                'Clear Data',
                'Book Flights'
            ],
            'Travel Agent' => [
                'Book Flights'
            ],
        ];

        // Loop through each role and assign permissions
        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();

            if ($role) {
                foreach ($permissions as $permissionName) {
                    $permission = Permission::where('name', $permissionName)->first();
                    
                    if ($permission) {
                        $role->givePermissionTo($permission);
                    }
                }
            }
        }
    }
}
