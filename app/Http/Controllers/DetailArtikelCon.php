<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 10/12/2015
 * Time: 11:26
 */

namespace App\Http\Controllers;


use App\Models\Artikel;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailArtikelCon extends Controller {
    public function getIndex(Request $request, Artikel $artikel, Komentar $komentar)
    {
        $data =[
            "getData"=>$artikel->getData($request->get('search'))
        ];

        return view('frontend.artikel', $data);
    }

    public function getDetail(Artikel $artikel, $idArtikel){
        $data=[
            "getData"=>$artikel->getData($idArtikel)
        ];
        return view('frontend.halamanartikel', $data);
    }
    public function postSubmit(Request $request)
    {
        $komentar = new Komentar();
        $komentar->idKomentar=$request->input('idKomentar');
        $komentar->isiKomentar=$request->input('isiKomentar');
        $komentar->save();

        return redirect('/artikel');
    }
}