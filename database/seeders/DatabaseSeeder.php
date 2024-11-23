<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route as FacadesRoute;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            'category', 'post', 'student', 'company', 'admin'
        ];
        
        $roleIds = [];
        foreach ($roles as $roleName) {
            $role = Role::factory()->create(['name' => $roleName]);
            $roleIds[] = $role->id;
        }

        for ($i = 1; $i <= 10; $i++) { 
            $user = User::create([
                'name' => 'User' . $i,
                'email' => 'email' . $i . '@gmail.com',
                'password' => Hash::make('qwerty'),
            ]);

            $user->roles()->attach($roleIds[array_rand($roleIds)]);
        }

        $routes = FacadesRoute::getRoutes();
        $groupNames = [];

        foreach ($routes as $route) {
            $key = $route->getName();
            if ($key && !str_starts_with($key, 'generated::') && $key !== 'storage.local') {
                $group = explode('.', $key)[0];
                if ($group) {
                    $groupNames[$group] = true;
                }
            }
        }

        foreach (array_keys($groupNames) as $name) {
            PermissionGroup::create(['name' => $name]);
        }

        foreach ($routes as $route) {
            $key = $route->getName();
            if ($key && !str_starts_with($key, 'generated::') && $key !== 'storage.local') {
                $name = ucfirst(str_replace('.', '-', $key));
                $group = explode('.', $key)[0];
                
                $permissionGroup = PermissionGroup::where('name', $group)->first();
                
                if ($permissionGroup) {
                    Permission::create([
                        'key' => $key,
                        'permission_group_id' => $permissionGroup->id,
                        'name' => $name,
                    ]);
                }
            }
        }

        $permissions = Permission::pluck('id')->toArray();
        foreach ($roleIds as $roleId) {
            Role::find($roleId)->permissions()->attach($permissions);
        }

        // Uncomment if additional seeders are needed
        $this->call([
            PostSeeder::class,
            StudentSeeder::class,
            CategorySeeder::class,
            CompanySeeder::class,
        ]);
    }
}
