<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermittionController extends Controller
{
    public function createRolePermit($roleName, $permissionName){
        ### example $roleName = "penulis"
        ### example $permissionName = "Edit Artikel"

        $role = Role::updateOrCreate(["name" => $roleName]);
        $permission = Permission::updateOrCreate(["name" => $permissionName]);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        return response([
            "role_name" => $roleName,
            "permission_name" => $permissionName
        ], 200);
    }

    public function setRolePermit($id, $roleName, $permissionName){
        $user = User::where("id", $id)->first();
        $user->givePermissionTo($permissionName);
        $user->assignRole($roleName);
        $userUpdated = User::where("id", $id)->with("roles")->with("permissions")->first();
        return response([
            "id" => $id,
            "role_name" => $roleName,
            "permission_name" => $permissionName,
            "user" => $userUpdated
        ], 200);
    }

    public function revokeRole($id, $roleName){
        $user = User::where("id", $id)->first();
        $user->removeRole($roleName);
        $user = User::where("id", $id)->with("roles")->with("permissions")->first();
        return response($user, 200);
    }

    public function revokePermittion($id, $permissionName){
        $user = User::where("id", $id)->first();
        $user->revokePermissionTo($permissionName);
        $user = User::where("id", $id)->with("roles")->with("permissions")->first();
        return response($user, 200);
    }
}
