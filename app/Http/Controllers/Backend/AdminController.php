<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 03/12/2015
 * Time: 16:05
 */

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

class AdminController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getIndex()
    {
        return view('backend.index');
    }





}