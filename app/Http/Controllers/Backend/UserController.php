<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 03/12/2015
 * Time: 16:22
 */

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{
    public function __construct()
    {

    }
    public function getIndex(User $user)
    {
        $data = [
            "getData"=>$user->getData()
        ];
        return view('backend.users.index', $data);
    }

    public function getAdd()
    {
        return view('backend.users.add');
    }

    public function postSubmit(Request $request)
    {
        if($request->input('id') != "")
        {
            $users = User::find($request->input('id'));
            if(count($users) > 0)
            {
                $users->name=$request->input('name');
                $users->username=$request->input('username');
                $users->email=$request->input('email');
                $users->password=bcrypt($request->input('password'));
                $users->save();
            }

            else
            {
                $users=new User();
                $users->id=$request->input('id');
                $users->name=$request->input('name');
                $users->username=$request->input('username');
                $users->email=$request->input('email');
                $users->password=bcrypt($request->input('password'));
                $users->save();
            }
        }
        else
        {
            $users=new User();
            $users->id=$request->input('id');
            $users->name=$request->input('name');
            $users->username=$request->input('username');
            $users->email=$request->input('email');
            $users->password=bcrypt($request->input('password'));
            $users->save();
        }
        return redirect('/admin/users');
    }
}