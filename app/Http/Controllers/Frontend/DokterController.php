<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 09/12/2015
 * Time: 9:57
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller{
    public function getIndex(Konsultasi $konsultasi)
    {
        $data = [
          "getData"=>$konsultasi->getData()
        ];
        return view('frontend.dokter.index', $data);
    }

    public function getLihat(Konsultasi $konsultasi, $idKonsultasi)
    {
        $data = [
          "getData"=>$konsultasi->getData($idKonsultasi)
        ];
        return view('frontend.dokter.lihat', $data);
    }

    public function postSubmit(Request $request)
    {
            $konsultasi = Konsultasi::find($request->input('idKonsultasi'));
            if(count($konsultasi) > 0)
            {
                $konsultasi->balasan=$request->input('balasan');
                $konsultasi->save();
            }
            else
            {
                $konsultasi=new Konsultasi();
                $konsultasi->balasan=$request->input('balasan');
                $konsultasi->save();
            }

        return redirect('dokter');
        /*$kirim=new Konsultasi();
        $kirim->balasan=$request->input('balasan');
        $kirim->save();
        return redirect('dokter/index'); */

    }

    public function Konsultasi($idKonsultasi)
    {
        $find = Konsultasi::find($idKonsultasi);
        $data = DB::table("tblkonsultasi")->join('users','users.id','=','tblkonsultasi.id')
            ->where("tblkonsultasi.id",'=',$id)
            ->get();
        $satudata = [
            "konsultasi" => $find,
            "data" => $data
        ];
        return view("/konsultasi/konsultasi",$satudata);
    }
}