<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class PermissionController extends Controller
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function create()
    {
        //$list_permission = $this->permission->all();
        $list_permission = $this->permission->all()->groupBy(function ($per) {
            return explode('.', $per->keycode)[0];
        });

//        $test_permission = $this->permission->get('keycode');
//        dd($test_permission);
//        $array = array();
//        $array = array(
//           'explode('.',$test_permission->keycode)[0]' => array(
//                'explode('.',$test_permission->keycode)[1]' => explode('.',$test_permission->keycode)[0]
//           ),
//        );
        //print_r($array);
//        $string = "name.view";
//        print_r(explode('.',$string)[0]);

        //dd($list_permission);

        return view('admin.permission.list',compact('list_permission'));
    }

    public function add()
    {
        $list_permission = $this->permission->all()->groupBy(function ($per) {
            return explode('.', $per->keycode)[0];
        });
        return view('admin.permission.add',compact('list_permission'));
    }

    public function store(Request $request)
    {


        $validated = $request->validate(
            [
                'name' => "required | max :255",
                'permission' => "required"
            ],
            [
                'required' => "Không được để trống trường này",
                'max:255' => "độ dài tối đa 255 kí tự",

            ]);
        $keyWord = $request->name;
        $permissions = $request->permission;

        foreach ($permissions as $permission) {
            $this->permission->create([
                'name' => $keyWord,
                'keycode' => $keyWord . '.' . $permission
            ]);
        }
        return redirect()->route('permission.add')->with('status', 'Thêm quyền thành công!');
    }

    public function delete($id)
    {
        $this->permission->find($id)->delete();
        return redirect()->route('role.index');
    }
}
