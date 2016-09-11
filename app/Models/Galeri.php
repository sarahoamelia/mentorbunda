<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 06/12/2015
 * Time: 20:07
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Galeri extends Model{
    protected $table = 'tblgaleri';
    protected $primaryKey = 'idGaleri';
    protected $fillable = ['kontenGaleri', 'namaGaleri', 'created_at', 'updated_at'];
    public $timestamps = true;

    public function getData($search='')
    {
        $data=$this->where('idGaleri', 'like', '%'.$search.'%')->get();
        return $data;
    }
}