<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model{
    protected $primaryKey = 'idLesson';
    protected $table = 'Lesson';
    protected $fillable = ['endDate', 'startDate', 'subject', 'content', 'idUser', 'idCategory', 'urlLesson', 'image'];
    // protected $hidden   = ['created_at', 'updated_at'];

    public function problematics(){
        return $this->hasMany('App\Problematic', 'idLesson');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'idLesson');
    }

    public function user(){
        return $this->belongsTo('App\User', 'idLesson');
    }
}
