<?php
/**
 * Created by PhpStorm.
 * User: rizqy
 * Date: 25/11/2015
 * Time: 11:48
 */

namespace App\Http\Controllers\DokterController;


use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sarav\Multiauth\Foundation\AuthenticatesAndRegistersUsers;

class AuthController extends Controller{
    use AuthenticatesAndRegistersUsers;

    public function __construct(Guard $auth)
    {
        $this->user = "dokter";

        $this->middleware('dokter.guest', ['except' => 'getLogout']);
    }

    public function create(array $data){
        return Dokter::create([
            'username'=>$data['username'],
            'password'=> bcrypt($data['password']),
            'namaDokter'=>$data['namaDokter'],
            'alamat'=>$data['alamat'],
            'namars'=>$data['namars'],
            'alamatrs'=>$data['alamatrs'],
        ]);
    }

    public function getLogout(){
        $this->auth->logout();
        return redirect('/dokter');
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

        if(\Auth::attempt("dokter", ['username'=>$username,'password'=>$password])){
            return redirect()->intended($this->redirectPath());
        }


        return redirect($this->loginPath())
            ->withInput($request->only($field))
            ->withErrors([
                    'login' => 'Maaf Email dan password anda tidak cocok',
                ]);
    }


    public function loginPath(){
        return property_exists($this, 'loginPath') ? $this->loginPath(): '/dokter/login';
    }

    public function redirectPath(){
        if(property_exists($this, 'redirectPath')){
            return $this->redirectPath();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo: 'dokterdash';
    }
}