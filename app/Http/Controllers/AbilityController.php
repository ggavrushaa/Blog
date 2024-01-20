<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class AbilityController extends Controller
{
    public function index()
    {
        $admins = User::query()
        ->where('admin', 1)
        ->get();

        return view('admin.admins.index', compact('admins'));
    }

    public function show(Request $request, $id)
    {
       $admin = User::query()->with('permissions')->where('id', $id)->first();
        $permissions = Permission::with('user')->where('id', $id)->get();
        return view('admin.admins.show', compact('admin', 'permissions'));
    }

    public function delete(Request $request)
    {
        
        $input = Validator::make($request->all(),[
            'id' => 'required|numeric',
        ]);
        if($input->fails()){
            return
                redirect()
                    ->back()
                    ->withErrors($input);
        }

        $query = User::query()
            ->where('id', $input->validated()['id'])
            ->update(['admin' => 0]);
        return ($query)
                ? redirect()
                    ->back()
                    ->withSuccess(['success' => 'Я успешно удалил этого админа']) 
                : redirect()
                    ->back()
                    ->withErrors(['error' => "Ошибка обновления записи в БД"]);
    }   
    public function create(User $user)
    {
        $admins = User::query()
        ->where('admin', 0)
        ->get();

        return view('admin.admins.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $admin = User::find($user_id);
        $admin->update(['admin' => 1]);

        $admins = User::query()
        ->where('admin', 1)
        ->get();

        return view('admin.admins.index', compact('admins'));
    }
}
