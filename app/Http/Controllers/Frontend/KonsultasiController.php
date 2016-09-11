<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 09/12/2015
 * Time: 11:04
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KonsultasiController extends Controller {
    public function getIndex(Dokter $dokter)
    {
        DB::table('tblkonsultasi')
            ->join('tbldokter', 'tblkonsultasi.idDokter', '=', 'tbldokter.idDokter')
            ->select('tblkonsultasi.idDokter')
            ->get();

        if (Auth::guest()){
            return view('auth/login');
        }
        else
        {
            $data = [
                "getData"=>$dokter->getData()
            ];
            return view('frontend.konsultasi', $data);

        }
    }

    public function postSubmit(Request $request)
    {
        $konsultasi=new Konsultasi();
        $konsultasi->idKonsultasi=$request->input('idKonsultasi');
        $konsultasi->pesan=$request->input('pesan');
        $konsultasi->save();

        return redirect('/konsultasi');
    }

    public function getKonsul(Dokter $dokter, $idDokter)
    {

        $data =[
            "getData"=>$dokter->getData($idDokter)
        ];
        return view('frontend.kirimpesan', $data);
    }

    public function getBalasan()
    {

    }


}