<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 01/12/2015
 * Time: 15:32
 */

namespace App\Http\Controllers;


class PenggunaController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('user.userindex');
    }

    public function getTentang()
    {
        return view('user.usertentang');
    }

    public function getGaleri()
    {
        return view('user.usergaleri');
    }

    public function getArtikel()
    {
        return view('user.userartikel');
    }

    public function getAcara()
    {
        return view('user.useracara');
    }
}