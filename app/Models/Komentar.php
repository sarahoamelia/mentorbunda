<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 22/12/2015
 * Time: 0:01
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Komentar extends Model {
    protected $table = 'tblkomentar';
    protected $primaryKey = 'idKomentar';
    protected $fillable = ['idArtikel', 'isiKomentar', 'created_at', 'updated_at'];
    public $timestamps = true;

    public function getDatakomentar($search='')
    {
        $data=$this->where('idKomentar', 'like', '%'.$search.'%')->get();
        return $data;
    }
}