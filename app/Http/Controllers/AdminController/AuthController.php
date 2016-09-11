<?php
/**
 * Created by PhpStorm.
 * User: rizqy
 * Date: 25/11/2015
 * Time: 11:48
 */

namespace App\Http\Controllers\AdminController;


use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sarav\Multiauth\Foundation\AuthenticatesAndRegistersUsers;

class AuthController extends Controller{
    use AuthenticatesAndRegistersUsers;

    public function __construct(Guard $auth)
    {
        $this->user = "admin";

        $this->middleware('admin.guest', ['except' => 'getLogout']);
    }

    public function create(array $data){
        return Admin::create([
            'username'=>$data['username'],
            'password'=> bcrypt($data['password']),
        ]);
    }

    public function getLogout(){
        $this->auth->logout();
        return redirect('/admin');
    }
    public function postCreate(Request $request){
        $this->auth->login($this->create($request->all()));
        return redirect($this->redirectPath());
    }
    public function getLogin(){
        return view('dokter.login');
    }

    public function postLogin(Request $request){
        $username=$request->input('username');
        $password=$request->input('password');

        $field = 'username';
        $request->merge([$field=>$request->input('username')]);

        $credentials = $request->only([$field, 'password']);

        if(\Auth::attempt("admin", ['username'=>$username,'password'=>$password])){
            return redirect()->intended($this->redirectPath());
        }


        return redirect($this->loginPath())
            ->withInput($request->only($field))
            ->withErrors([
                    'login' => 'Maaf Username dan password anda tidak cocok',
                ]);
    }


    public function loginPath(){
        return property_exists($this, 'loginPath') ? $this->loginPath(): '/admin/login';
    }

    public function redirectPath(){
        if(property_exists($this, 'redirectPath')){
            return $this->redirectPath();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo: 'admindash';
    }
}