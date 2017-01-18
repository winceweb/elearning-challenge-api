<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model{
    protected $primaryKey = 'idLesson';
    protected $table = 'Lesson';
    protected $fillable = ['endDate', 'startDate', 'subject', 'idUser', 'idCategory'];
    // protected $hidden   = ['created_at', 'updated_at'];
}

public function problematics(){
    return $this->hasMany('App\Problematic');
}
