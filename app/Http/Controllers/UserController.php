<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Jobs\UserStore;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public function index(){
        // $routes = Route::getRoutes();
        // $group_names = [];
        // foreach ($routes as $route) {
        //     $result = explode('.',$route->getName())[0];
        //     $group_names[] = $result;
        // }
        // $group_names = array_unique($group_names);
        // dd($group_names);
        $users = User::with('roles')->paginate(15);
    
        $users->getCollection()->transform(function ($user) {
            $user->roles_name = $user->roles->pluck('name')->toArray();
            return $user;
        });
    
        $roles = Role::all();
    
        return view('user.users', [
            'users' => $users,
            'roles' => $roles
        ]);
    }
    
    

    public function changeUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:show,delete,edit,create,admin',
        ]);
    
        $user = User::findOrFail($id);
        $user->update([
            'role' => $request->role,
        ]);
    
        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function edit(User $user){
        $roles = Role::all();
        return view('user.user_edit',['user'=>$user,'roles'=>$roles]);
    }

    public function store(StoreUserRequest $request)
    {
        // Dispatch the job to the queue
        UserStore::dispatch($request->validated());

        return redirect('/users')->with('success', 'User creation is in progress.');
    }
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->roles()->sync($request->roles);

        $user->save();

        return redirect('/users')->with('success', 'User updated successfully!');
    }


    public function destroy(User $user){

        if($user){
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User  deleted successfully.');
        }
        return redirect()->route('user.index')->with('error', 'Error While Deleting User');
    }
    
    

}
