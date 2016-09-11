<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 09/12/2015
 * Time: 2:07
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;
use yajra\Datatables\Facades\Datatables;

class DokterController extends Controller {
    public function getIndex()
    {
        $dokter = Dokter::paginate(10);
        return view('backend.dokter.index', compact('dokter'));
    }

    public function getData()
    {
        $dokter = Dokter::select(['idDokter', 'username', 'password', 'namaDokter', 'alamat', 'namars', 'alamatrs', 'remember_token', 'created_at', 'updated_at']);
        return Datatables::of($dokter)->make();
    }

    public function getAdd()
    {
        return view('backend.dokter.add');
    }

    public function postSubmit(Request $request)
    {
        if($request->input('idDokter') != "")
        {
            $dokter = Dokter::find($request->input('idDokter'));
            if(count($dokter) > 0)
            {
                $dokter->username=$request->input('username');
                $dokter->password=$request->input('password');
                $dokter->namaDokter=$request->input('namaDokter');
                $dokter->alamat=$request->input('alamat');
                $dokter->namars=$request->input('namars');
                $dokter->alamatrs=$request->input('alamatrs');
                $dokter->save();
            }
            else
            {
                $dokter=new Dokter();
                $dokter->username=$request->input('username');
                $dokter->password=$request->input('password');
                $dokter->namaDokter=$request->input('namaDokter');
                $dokter->alamat=$request->input('alamat');
                $dokter->namars=$request->input('namars');
                $dokter->alamatrs=$request->input('alamatrs');
                $dokter->save();
            }
        }
        else
        {
            $dokter=new Dokter();
            $dokter->username=$request->input('username');
            $dokter->password=$request->input('password');
            $dokter->namaDokter=$request->input('namaDokter');
            $dokter->alamat=$request->input('alamat');
            $dokter->namars=$request->input('namars');
            $dokter->alamatrs=$request->input('alamatrs');
            $dokter->save();
        }

        return redirect('/admin/dokter');
    }

    public function getEdit(Dokter $dokter, $idDokter)
    {
        $data = [
          "getData"=>$dokter->getData($idDokter)
        ];
        return view('backend.dokter.edit', $data);
    }

    public function getDelete($idDokter)
    {
        Dokter::where('idDokter', '=', $idDokter)->delete();
        return redirect('admin/dokter');
    }
}