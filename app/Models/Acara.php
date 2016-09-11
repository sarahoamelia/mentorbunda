<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 09/12/2015
 * Time: 4:11
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Acara extends Model{
    protected $table = 'tblacara';
    protected $primaryKey = 'idAcara';
    protected $fillable = ['namaAcara', 'image', 'deskAcara', 'created_at', 'updated_at'];
    public $timestamps = true;

    public function getData($search='')
    {
        $data=$this->where('idAcara', 'like', '%'.$search.'%')->get();
        return $data;
    }
}