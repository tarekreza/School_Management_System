<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function UserView()
    {
        $allData = User::where('usertype','Admin')->get();
        return view('backend.user.view_user',compact('allData'));
    }
    public function UserAdd()
    {
        return view('backend.user.add_user');
    }
    public function UserStore(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required | unique:users',
            'name' => 'required'
        ]);
        $data = new User();
        $code = rand(0000,9999);
        $data->usertype = 'Admin';
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->save();
        return redirect()->route('users.view');
    }
    public function UserEdit($id)
    {
        $editData = User::find($id);
        return view('backend.user.edit_user',compact('editData'));
    }
    public function UserUpdate(Request $request, $id)
    {
        $data = User::find($id);
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();
        return redirect()->route('users.view');
    }
    public function UserDelete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
