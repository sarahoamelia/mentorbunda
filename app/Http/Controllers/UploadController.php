<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 06/12/2015
 * Time: 18:00
 */

namespace App\Http\Controllers;


class UploadController extends Controller {
    public function getIndex()
    {
        return view('backend.upload');
    }

    public function upload(){
        echo "Uploaded";
    }
}