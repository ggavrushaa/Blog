<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view', User::class);
        $users = User::latest()
        ->paginate(6);
        return view('admin.index', compact('users'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', User::class);
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validated = validate($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'admin' => ['required'],
            'password' => ['required', 'string', 'max:10000'],
            'published_at' => ['nullable', 'string', 'date',],
            'published' => ['nullable', 'boolean'],
        ]);

        $user = User::firstOrNew([
            'name' => $validated['name'],
        ]);
        
        if (!$user->exists) {
            $user->email = $validated['email'];
            $user->admin = $validated['admin'];
            $user->password = bcrypt($validated['admin']);
            $user->save();
        }


        alert(__('Сохранено!'));

        return redirect()->route('admin.panel', compact('user'));
    }

    public function delete($id)
    {
        $this->authorize('delete', User::class);
        $user = User::find($id);

        if($user) {
            $user->posts()->delete();
            $user->delete();
            return redirect()->route('admin.panel')
            ->with('success', 'Я успешно удалил бедолагу');
        } else {
            return redirect()->route('admin.panel')
            ->with('error', 'Он сильнее, чем я думал');
        }

    }

    public function edit($id, User $user)
    {
        $this->authorize('update', $user);
        $user = User::find($id);

        if(!$user) {
            return redirect()->route('admin.panel')
            ->with('error', 'Не нашли типочка');
        }
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id, User $user)
    {
        $this->authorize('update', $user);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'admin' => 'required',
        ]);

        $user = User::find($id);
        if(!$user){
            return redirect()->route('admin.panel')
                ->with('error', 'Мы не смогли его найти, шифруется молорик');
        }

        $user->update($validated);
        return redirect()->route('admin.panel')
                ->with('success', 'Молорик');
    
    }

    public function show(Request $request, $id, User $user)
    {
        $this->authorize('view', $user);
        $user = User::find($id);
        if(!$user){
            return redirect()->route('admin.panel')
                ->with('error', 'Мы не смогли его найти, шифруется молорик');
        }
        return view('admin.show', compact('user'));
    }
}
