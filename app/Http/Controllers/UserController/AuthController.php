<?php
/**
 * Created by PhpStorm.
 * User: rizqy
 * Date: 25/11/2015
 * Time: 11:48
 */

namespace App\Http\Controllers\UserController;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sarav\Multiauth\Foundation\AuthenticatesAndRegistersUsers;

class AuthController extends Controller{
    use AuthenticatesAndRegistersUsers;

    public function __construct(Guard $auth)
    {
        $this->user = "auth";

        $this->middleware('admin.guest', ['except' => 'getLogout']);
    }

    public function create(array $data){
        return User::create([
            'name'=>$data['name'],
            'username'=>$data['username'],
            'email'=> $data['email'],
            'password'=> bcrypt($data['password']),
        ]);
    }

    public function getLogout(){
        $this->auth->logout();
        return redirect('/front');
    }
    public function postCreate(Request $request){
        $this->auth->login($this->create($request->all()));
        return redirect($this->redirectPath());
    }
    public function getLogin(){
        return view('authadmin.login');
    }

    public function postLogin(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');

        $field = 'email';
        $request->merge([$field=>$request->input('email')]);

        $credentials = $request->only([$field, 'password']);

        if(\Auth::attempt("admin", ['email'=>$email,'password'=>$password])){
            return redirect()->intended($this->redirectPath());
        }


        return redirect($this->loginPath())
            ->withInput($request->only($field))
            ->withErrors([
                    'login' => 'Maaf Email dan password anda tidak cocok',
                ]);
    }


    public function loginPath(){
        return property_exists($this, 'loginPath') ? $this->loginPath(): '/admin/login';
    }

    public function redirectPath(){
        if(property_exists($this, 'redirectPath')){
            return $this->redirectPath();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo: 'front';
    }
}