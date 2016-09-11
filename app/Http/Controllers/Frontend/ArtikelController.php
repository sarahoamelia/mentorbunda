<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 10/12/2015
 * Time: 14:39
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtikelController extends Controller{
    public function getIndex(Artikel $artikel)
    {
        DB::table('tblkomentar')
            ->join('tblartikel', 'tblkomentar.idArtikel', '=', 'tblartikel.idArtikel')
            ->select('tblartikel.idArtikel')
            ->get();
        $data = [
            "getData"=>$artikel->getData()
        ];
        return view('frontend.artikel', $data);
    }




}