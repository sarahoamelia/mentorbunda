<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 01/12/2015
 * Time: 4:09
 */

namespace App\Http\Controllers;


use App\Models\Acara;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\User;
use Illuminate\Http\Request;

class MentorBundaController extends Controller
{


    public function getIndex()
    {
        return view('frontend.index');
    }

    public function getTentang()
    {
        return view('frontend.tentang');
    }

    public function getGaleri(Galeri $galeri)
    {
        $data =[
          "getData"=>$galeri->getData()
        ];
        return view('frontend.galeri', $data);
    }


    public function getHalamanartikel(Artikel $idArtikel)
    {
        $find = Artikel::find($idArtikel);
        $data = $find;
        return view("frontend.halamanartikel",$data);
    }

    public function getAcara(Request $request, Acara $acara)
    {
        $data = [
          "getData"=>$acara->getData($request->get('search'))
        ];
        return view('frontend.acara', $data);
    }

    public function getAnak()
    {
        return view('frontend.anak');
    }







}
