<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\Role\StoreRoleRequest;
use App\Http\Requests\UserManagement\Role\UpdateRoleRequest;
use App\Models\Settings\LetterHead;
use App\Models\UserManagement\Permission;
use App\Models\UserManagement\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('role_access');

        $roles = Role::all();

        return view('admin.userManagement.role.index', compact('roles'));
    }

    public function create()
    {
        $this->checkAuthorization('role_create');

        $permissionGroups = $this->permissionGroups();

        return view('admin.userManagement.role.create', compact('permissionGroups'));
    }

    public function store(StoreRoleRequest $request)
    {
        $this->checkAuthorization('role_create');

        DB::transaction(function () use ($request) {
            $role = Role::create($request->validated());

            $role->permissions()->attach($request->validated()['permissions']);

            $this->permissionCacheClear();
        });

        toast('भूमिका सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }

    public function show(Role $role)
    {
        $this->checkAuthorization('role_access');
    }

    public function edit(Role $role)
    {
        $this->checkAuthorization('role_edit');

        $role->load('permissions');
        $permissionGroups = $this->permissionGroups();

        return view('admin.userManagement.role.edit', compact('role', 'permissionGroups'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->checkAuthorization('role_edit');

        DB::transaction(function () use ($request, $role) {
            $role->update($request->validated());
            $role->permissions()->sync($request->validated()['permissions']);

            $this->permissionCacheClear();
        });

        toast('भूमिका सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.systemSetting.userManagement.role.index'));
    }

    public function destroy(Role $role)
    {
        $this->checkAuthorization('role_delete');

        if ($role->type == 'Super') {
            toast('super role मेटाउन सकिँदैन', 'error');

            return back();
        }
        $this->permissionCacheClear();

        $role->permissions()?->detach();
        $role->delete();

        toast('भूमिका सफलतापूर्वक मेटियो', 'success');

        return back();
    }
    /**
     * @return void
     */
    public function permissionCacheClear(): void
    {
        if (Cache::has(md5('permissions-' . auth()->id()))) {
            //
            Cache::forget(md5('permissions-' . auth()->id()));
        }
    }

    private function permissionGroups()
    {
        return Permission::all()
            ->map(function ($permission) {
                $array = explode('_', $permission->title);
                $last = array_pop($array);

                return [
                    'id' => $permission->id,
                    'name' => Str::headline(implode(' ', $array)),
                    'title' => Str::headline($last),
                ];
            })->groupBy('name');
    }
}
