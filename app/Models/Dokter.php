<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 07/12/2015
 * Time: 16:51
 */

namespace App\Models;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model implements Authenticatable, CanResetPassword{
    use \Illuminate\Auth\Authenticatable, \Illuminate\Auth\Passwords\CanResetPassword;
    protected $table = 'tbldokter';
    protected $primaryKey = 'idDokter';
    protected $fillable = ['username', 'password', 'namaDokter', 'alamat', 'namars', 'alamatrs','created_at', 'updated_at'];
    protected $hidden = ['password', 'remember_token'];
    public $timestamps = true;

    public function Dokter()
    {
        $this->hasOne("konsultasi", "App\Models\Konsultasi");
    }

    public function getData($search='')
    {
        $data=$this->where('idDokter', 'like', '%'.$search.'%')->get();
        return $data;
    }
}