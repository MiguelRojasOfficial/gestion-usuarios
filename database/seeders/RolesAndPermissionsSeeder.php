<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $user = Role::create(['name' => 'user']);

        $permissions = ['create-posts', 'edit-posts', 'delete-posts', 'view-dashboard'];

        foreach ($permissions as $perm) {
            $permission = Permission::create(['name' => $perm]);
            $admin->permissions()->attach($permission->id);
        }

        $editor->permissions()->attach([
            Permission::where('name', 'create-posts')->first()->id,
            Permission::where('name', 'edit-posts')->first()->id
        ]);

    }


}
