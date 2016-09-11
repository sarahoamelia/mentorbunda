<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 09/12/2015
 * Time: 5:04
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model {
    protected $table = 'tblkonsultasi';
    protected $primaryKey = 'idKonsultasi';
    protected $fillable = ['idDokter', 'id', 'pesan', 'balasan', 'created_at', 'updated_at'];
    public $timestamps = true;

    public function Konsultasi()
    {
        $this->hasMany("konsultas", "App\Models\Dokter", "App\User");
    }

    public function getData($search='')
    {
        $data=$this->where('idKonsultasi', 'like', '%'.$search.'%')->get();
        return $data;
    }
}