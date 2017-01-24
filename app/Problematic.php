<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problematic extends Model{
    protected $primaryKey = 'idProblematic';
    protected $table = 'Problematic';
    protected $fillable = ['movieUrl', 'caption', 'entitled', 'idUser', 'idLesson'];
    // protected $hidden   = ['created_at', 'updated_at'];
    public function lesson(){
        return $this->belongsTo('App\Lesson', 'idProblematic');
    }

    public function user(){
        return $this->belongsTo('App\User', 'idProblematic');
    }

    public function commentaries(){
        return $this->hasMany('App\Commentary', 'idProblematic');
    }
}
