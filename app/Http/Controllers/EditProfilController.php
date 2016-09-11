<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 04/12/2015
 * Time: 11:16
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class EditProfilController extends Controller{
    public function __construct()
    {

    }

    public function getIndex(User $user, $id)
    {
        $data = [
            "getData"=>$user->getData($id)
        ];
        return view('frontend.editprofil', $data);
    }



}