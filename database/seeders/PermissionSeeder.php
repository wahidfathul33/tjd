<?php

namespace Database\Seeders;

use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route as RouteFacade;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $this->createPermissions();
    }

    protected function createPermissions(): void
    {
        foreach (Role::all() as $role) :
            if ($role->name == 'admin') :

                $permissions = collect($this->permissionNames())->map(function ($permission) {
                    return ['name' => $permission, 'guard_name' => 'web'];
                });

                DB::table('permissions')->insert($permissions->toArray());

                $role->givePermissionTo(Permission::all());
            endif;
        endforeach;
    }

    protected function permissionNames(): array
    {
        $arrayOfPermissionNames = [];

        foreach (RouteFacade::getRoutes() as $route) :
            foreach ($route->methods as $method) :

                if (in_array($method, ['HEAD', 'PATCH'])) {
                    continue;
                }

                if ($route->getName()) :
                    $arrayOfPermissionNames[] = str_replace('.', '_', $route->getName());
                endif;

            endforeach;
        endforeach;

        return $arrayOfPermissionNames;
    }
}
