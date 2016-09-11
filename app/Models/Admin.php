<?php
    /**
     * Created by PhpStorm.
     * User: Sarah
     * Date: 07/12/2015
     * Time: 16:44
     */

namespace App\Models;


    use Illuminate\Contracts\Auth\Authenticatable;
    use Illuminate\Contracts\Auth\CanResetPassword;
    use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements Authenticatable, CanResetPassword{
    use \Illuminate\Auth\Authenticatable, \Illuminate\Auth\Passwords\CanResetPassword;
    protected $table = 'tbladmin';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'password'];
    protected $hidden = ['password', 'remember_token'];
    public $timestamps = true;

    public function getData($search='')
    {
        $data=$this->where('id', 'like', '%'.$search.'%')->get();
        return $data;
    }

}