<?php

namespace App\Http\Controllers\Api;

use App\Exports\Roles\RolesExport;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Excel;

class RoleController extends Controller
{
    public function get(Request $request, Role $role) {
        try {
            $this->authorize("role.show");
            $role->makeVisible('permissions_matrix');
            $role->load('permissions');
            return jsonRes(true,"Role $role->display_name", $role,200);
        } catch (AuthorizationException $exception) {
            return jsonRes(false, $exception->getMessage(),[],403);
        } catch (\Throwable $exception) {
            return jsonRes(false, $exception->getMessage());
        }
    }
    public function permissions(Request $request, Role $role) {
        $this->authorize("permission.index");
        $perms = $role->permissions;
        return jsonRes(true, "Role Permissions", $perms,200);
    }
    public function togglePermission(Request $request, Role $role) {
        try {
            $this->authorize('role.edit', $role);
            $request->validate([
                "permission" => ["required","string"],
                "checked" => ["boolean"]
            ]);
            $perm = perm($request->permission,$role->guard_name);
            if (!$perm) {
                return jsonRes(false, "The permission $request->permission could not be found on the $role->guard_name guard",[],404);
            }
            if ($request->checked) {
                $role->givePermissionTo($perm->name);
            } else {
                if ($role->hasPermissionTo($perm->name)) {
                    $role->revokePermissionTo($perm->name);
                }
            }
            $res = $perm->toArray();
            $res["checked"] = $request->checked;
            return jsonRes(true, "Permission has been updated",collect($res));
        } catch (ValidationException $exception) {
            return jsonRes(false, $exception->validator->getMessageBag()->first(),[],422);
        } catch (AuthorizationException $exception) {
            return jsonRes(false, $exception->getMessage(),[],403);
        } catch (\Throwable $exception) {
            return jsonRes(false, $exception->getMessage(),[],400);
        }
    }
    public function togglePermissionGroup(Request $request, Role $role) {
        try {
            $this->authorize('role.edit', $role);
            $request->validate([
                "permission_group" => ["required","string"],
                "checked" => ["boolean"]
            ]);

            $perm = perm($request->permission,$role->guard_name);
            if (!$perm) {
                return jsonRes(false, "The permission $request->permission could not be found on the $role->guard_name guard",[],404);
            }
            if ($request->checked) {
                $role->givePermissionTo($perm->name);
            } else {
                if ($role->hasPermissionTo($perm->name)) {
                    $role->revokePermissionTo($perm->name);
                }
            }
            $res = $perm->toArray();
            $res["checked"] = $request->checked;
            return jsonRes(true, "Permission has been updated",collect($res));
        } catch (ValidationException $exception) {
            return jsonRes(false, $exception->validator->getMessageBag()->first(),[],422);
        } catch (AuthorizationException $exception) {
            return jsonRes(false, $exception->getMessage(),[],403);
        } catch (\Throwable $exception) {
            return jsonRes(false, $exception->getMessage(),[],400);
        }
    }
    public function toggleAllPermissions(Request $request, Role $role) {
        try {
            $this->authorize('role.edit',$role);
            $request->validate([
                "checked" => ["required","boolean"]
            ]);
            if ($request->checked) {
                $perms = Permission::whereGuardName($role->guard_name)->get()->pluck('id')->toArray();
            } else {
                if ($role->name ==='Administrator') {
                    throw new AuthorizationException("To prevent a possible self-lockout for the admins, this action has been denied.");
                }
                $perms = [];
            }
            $role->permissions()->sync($perms);
            return jsonRes(true, "Permissions have been synchronized", $role->permissions_matrix,200);
        } catch (ValidationException $exception) {
            return jsonRes(false, $exception->validator->getMessageBag()->first(),[],422);
        } catch (AuthorizationException $exception) {
            return jsonRes(false, $exception->getMessage(),[],403);
        } catch (\Throwable $exception) {
            return jsonRes(false, $exception->getMessage(),[],400);
        }
    }
}
