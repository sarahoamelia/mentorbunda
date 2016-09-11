<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 09/12/2015
 * Time: 23:20
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller{
    public function getIndex(Galeri $galeri)
    {
        $data=[
          "getData"=>$galeri->getData()
        ];

        return view('backend.galeri.index', $data);
    }

    public function getAdd()
    {
        return view('backend.galeri.add');
    }

    public function postSubmit(Request $request)
    {
        if($request->input('idGaleri') != "")
        {
            $galeri = Galeri::find($request->input('idGaleri'));
            if(count($galeri) > 0)
            {
                $galeri->namaGaleri=$request->input('namaGaleri');
                $galeri->kontenGaleri=$request->input('kontenGaleri');
                $galeri->save();
            }
            else
            {
                $galeri=new Galeri();
                $galeri->namaGaleri=$request->input('namaGaleri');
                $galeri->kontenGaleri=$request->input('kontenGaleri');
                $galeri->save();
            }
        }
        else
        {
            $galeri=new Galeri();
            $galeri->namaGaleri=$request->input('namaGaleri');
            $galeri->kontenGaleri=$request->input('kontenGaleri');
            $galeri->save();
        }

        return redirect('/admin/galeri');
    }

    public function getEdit(Galeri $galeri, $idGaleri)
    {
        $data=[
            "getData"=>$galeri->getData($idGaleri)
        ];
        return view('backend.galeri.index', $data);
    }

    public function getDelete($idGaleri)
    {
        Galeri::where('idGaleri', '=', $idGaleri)->delete();
        return redirect('admin/galeri');
    }
}