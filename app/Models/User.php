<?php
/**
 * Created by PhpStorm.
 * User: Sarah
 * Date: 03/12/2015
 * Time: 16:46
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'username', 'email', 'password', 'remember_token', 'created_at', 'updated_at'];
    public $timestamps = true;
    protected $hidden = ['password', 'remember_token'];

    public function getData($search='')
    {
        $data=$this->where('id', 'like', '%'.$search.'%')->get();
        return $data;
    }
}