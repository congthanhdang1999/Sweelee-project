<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Gate;
class AdminUserController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function show(Request $request)
    {
        $keyword = "";
        $status = $request->input('status');
        if ($status == "trash") {
            $listUser = $this->user->onlyTrashed()->paginate(8);
        } else {
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $listUser = $this->user->where('name', 'like', "%{$keyword}%")->paginate(8);
        }
        $count_user_active = $this->user->count();
        $count_user_trash = $this->user->onlyTrashed()->count();
        $count = [$count_user_active, $count_user_trash];
        //dd($keyword);
        //$listUser = $this->user->paginate(8);
        return view('admin.users.list', compact('listUser', 'count'));
    }

    public function add()
    {
        $roles = $this->role->all();
        return view('admin.users.add', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataUserCreate = $this->user->create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]
            );
            $roleId = $request->role_id;
            $dataUserCreate->roles()->attach($roleId);
            DB::commit();
            return redirect('admin/user/list');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('message:' . $exception->getMessage() . '---line' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $roles = $this->role->all(); //lấy ra tất cả vai trò
        $user = $this->user->find($id);
        $roleOfUser = $user->roles;//lấy ra ds vai trò của user đó
        //dd($roleOfUser);
        return view('admin.users.edit', compact('roles', 'user', 'roleOfUser'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataUserUpdate = $this->user->find($id)->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                ]
            );
            $user = $this->user->find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect('admin/user/list');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('message:' . $exception->getMessage() . '---line' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        $this->user->find($id)->delete();
        return redirect()->route('user.index');
    }

    public function test()
    {
//        $dataTest = $this->user->find(1)->roles;
        $data_user = $this->user->hasPermission('post.add');
//        return $data_user->permissions();
        //$user = Role::with('permissions')->get();
        //dd(Auth::user()->hasRoles());

    }
}
