<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 03/12/2015
 * Time: 17:14
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller {
    public function __construct()
    {

    }

    public function getIndex(Artikel $artikel)
    {
        $data =[
            "getData"=>$artikel->getData()
        ];
        return view('backend.artikel.index', $data);
    }

    public function getAdd()
    {
        return view('backend.artikel.add');
    }

    public function postSubmit(Request $request)
    {
        if($request->input('idArtikel') != "")
        {
            $artikel = Artikel::find($request->input('idArtikel'));
            if(count($artikel) > 0)
            {
                $artikel->judulArtikel=$request->input('judulArtikel');
                $artikel->gambar=$request->input('gambar');
                $artikel->penggalanArt=$request->input('penggalanArt');
                $artikel->isiArtikel=$request->input('isiArtikel');
                $artikel->save();
            }
            else
            {
                $artikel=new Artikel();
                $artikel->judulArtikel=$request->input('judulArtikel');
                $artikel->gambar=$request->input('gambar');
                $artikel->penggalanArt=$request->input('penggalanArt');
                $artikel->isiArtikel=$request->input('isiArtikel');
                $artikel->save();
            }
        }
        else
        {
            $artikel=new Artikel();
            $artikel->judulArtikel=$request->input('judulArtikel');
            $artikel->gambar=$request->input('gambar');
            $artikel->penggalanArt=$request->input('penggalanArt');
            $artikel->isiArtikel=$request->input('isiArtikel');
            $artikel->save();
        }

        return redirect('/admin/artikel');
    }

    public function getEdit(Artikel $artikel, $idArtikel)
    {
        $data=[
            "getData"=>$artikel->getData($idArtikel)
        ];
        return view('backend.artikel.edit', $data);
    }

    public function getDelete($idArtikel)
    {
        Artikel::where('idArtikel', '=', $idArtikel)->delete();
        return redirect('admin/artikel');
    }
}