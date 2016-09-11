<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 08/12/2015
 * Time: 20:53
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\User;
use yajra\Datatables\Datatables;

class UserrController extends Controller {
    public function getIndex()
    {
        $user = User::paginate(10);
        return view('backend.users.index', compact('user'));
    }

    public function getData()
    {
        $user = User::select(['id', 'name', 'username', 'email', 'password', 'remember_token', 'created_at', 'updated_at']);
        return Datatables::of($user)->make();
    }
}