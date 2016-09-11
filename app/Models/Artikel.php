<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 03/12/2015
 * Time: 17:18
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Artikel extends Model {
    protected $table = 'tblartikel';
    protected $primaryKey = 'idArtikel';
    protected $fillable = ['judulArtikel', 'gambar', 'penggalanArt', 'isiArtikel', 'created_at', 'updated_at'];
    public $timestamps = true;

    public function getData($search='')
    {
        $data=$this->where('idArtikel', 'like', '%'.$search.'%')->get();
        return $data;
    }
}