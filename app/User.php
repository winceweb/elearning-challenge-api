<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'isTeacher', 'isActive'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $primaryKey = 'idUser';
    protected $table = 'User';

    public function verify($email, $password){

        $user = User::where('email', $email)->first();

        if($user && Hash::check($password, $user->password)){
            return $user->idUser;
        }
        return false;
    }
    public function problematics(){
        return $this->hasMany('App\Problematic', 'idUser');
    }

    public function lessons(){
        return $this->hasMany('App\Problematic', 'idUser');
    }
}
