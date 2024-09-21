<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Permission;

class GroupPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Assign permissions to Admin group
        $adminGroup = Group::where('name', 'admin')->first();
        $adminPermissions = Permission::whereIn('permissions_name', ['view_all', 'view_row', 'edit', 'delete', 'update'])->get();
        $adminGroup->permissions()->sync($adminPermissions);

        // Assign permissions to Employee group
        $employeeGroup = Group::where('name', 'employee')->first();
        $employeePermissions = Permission::whereIn('permissions_name', ['view_all', 'view_row', 'edit', 'delete', 'update'])->get();
        $employeeGroup->permissions()->sync($employeePermissions);

        // Assign permissions to Trader group
        $traderGroup = Group::where('name', 'trader')->first();
        $traderPermissions = Permission::whereIn('permissions_name', ['view_all', 'view_row', 'edit'])->get();
        $traderGroup->permissions()->sync($traderPermissions);

        // Assign permissions to Delivery Man group
        $deliveryManGroup = Group::where('name', 'delivery_man')->first();
        $deliveryManPermissions = Permission::whereIn('permissions_name', ['view_all', 'view_row', 'edit', 'update'])->get();
        $deliveryManGroup->permissions()->sync($deliveryManPermissions);
    }
}
