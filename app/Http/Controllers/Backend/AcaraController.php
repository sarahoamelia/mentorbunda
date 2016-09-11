<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 09/12/2015
 * Time: 4:09
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcaraController extends Controller {
    public function getIndex(Acara $acara)
    {
        $data = [
          "getData"=>$acara->getData()
        ];
        return view('backend.acara.index', $data);
    }

    public function getAdd()
    {
        return view('backend.acara.add');
    }

    public function postSubmit(Request $request)
    {
        if($request->input('idAcara') != "")
        {
            $acara = Acara::find($request->input('idAcara'));
            if(count($acara) > 0)
            {
                $acara->namaAcara=$request->input('namaAcara');
                $acara->image=$request->input('image');
                $acara->deskAcara=$request->input('deskAcara');
                $acara->save();
            }
            else
            {
                $acara=new Acara();
                $acara->namaAcara=$request->input('namaAcara');
                $acara->image=$request->input('image');
                $acara->deskAcara=$request->input('deskAcara');
                $acara->save();
            }
        }
        else
        {
            $acara=new Acara();
            $acara->namaAcara=$request->input('namaAcara');
            $acara->image=$request->input('image');
            $acara->deskAcara=$request->input('deskAcara');
            $acara->save();
        }

        return redirect('/admin/acara');
    }

    public function getEdit(Acara $acara, $idAcara)
    {
        $data = [
          "getData"=>$acara->getData($idAcara)
        ];

        return view('backend.acara.edit', $data);
    }

    public function getDelete($idAcara)
    {
        Acara::where('idAcara', '=', $idAcara)->delete();
        return redirect('admin/acara');
    }
}