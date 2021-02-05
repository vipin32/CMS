<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UsersController;
use App\Http\Requests\Users\UpdateProfileRequest;

use Illuminate\Http\Request;

use App\Models\User;

use Session;
use Log;      

class UsersController extends Controller
{
    public function index() {
        $users = User::all();

        return view('users.index', ['users'=>$users]);
    }

    public function makeAdmin($id) {
        $user = User::findOrFail($id);

        $user->role = 'admin';

        $user->update();

        session()->flash('success', 'User Role Updated Successfully');

        return redirect(route('users.index'));
    }   

    public function edit() {
        $user = auth()->user();

        Log::info('Latest');
        Log::info($user);

        return view('users.edit', ['user'=>$user]);
    }

    public function update(UpdateProfileRequest $request) {
        $user = auth()->user();

        $updateUser = User::findOrFail($user->id);
        
        $updateUser->name = $request->name;
        $updateUser->email = $request->email;
        $updateUser->password = $request->password;
        $updateUser->about = $request->about;

        $updateUser->update();

        session()->flash('success', 'User Updated Successfully');

        return redirect(route('users.edit-profile'));
        
    } 
}
