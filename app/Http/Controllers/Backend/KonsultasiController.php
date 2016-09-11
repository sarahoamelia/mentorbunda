<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 09/12/2015
 * Time: 5:04
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Konsultasi;

class KonsultasiController extends Controller {
    public function getIndex(Konsultasi $konsultasi)
    {
        $data = [
          "getData" => $konsultasi->getData()
        ];
        return view('backend.konsultasi.index', $data);
    }
}