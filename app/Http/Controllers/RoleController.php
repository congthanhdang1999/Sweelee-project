<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    private $role;
    private $permission;

    function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $listRole = $this->role->all();
        return view('admin.role.list', compact('listRole'));
    }

    public function add()
    {

        $list_permission = $this->permission->all()->groupBy(function ($per) {
            return explode('.', $per->keycode)[0];
        });
        return view('admin.role.add', compact('list_permission'));
    }

    public function store(Request $request)
    {

//        $request->validate([
//            'name' => 'required|max:255|unique:roles,name',
//            'display_name' => 'required|max:255',
//            'permission_id' => 'nullable|array',
//            'permission_id.*' => 'exists:permission,id'
//        ]);

        $dataRoleCreate = $this->role->create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name')
        ]);
        $dataRoleCreate->getPermission()->attach($request->input('permission_id'));
        return redirect()->route('role.index');

    }

    public function edit(Role $role)
    {
        $list_permission = $this->permission->all()->groupBy(function ($per) {
            return explode('.', $per->keycode)[0];
        });
        $permissions = $this->permission->all();

        $permissionOfRole = $role->permissions;

        return view('admin.role.edit', compact('role', 'list_permission', 'permissionOfRole', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
//            $validate = $request->validate([
//                'name' => 'required|max:255|unique:roles,name,' . $role->id,
//                'display_name' => 'required|max:255',
//                'permission_id' => 'nullable|array',
//                'permission_id.*' => 'exists:permission,id'
//            ]);
            $role->update([
                'name' => $request->input('name'),
                'display_name' => $request->input('display_name')
            ]);
            $role->permissions()->sync($request->input('permission_id', []));
            return redirect()->route('role.index')->with('status', 'Cập nhật vai trò thành công');
    }

    public function delete(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index')->with('status', 'Đã xoá vai trò thành công');
    }


}
