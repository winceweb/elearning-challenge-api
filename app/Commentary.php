<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentary extends Model{
    protected $primaryKey = 'idCommentary';
    protected $table = 'Commentary';
    protected $fillable = ['description', 'idProblematic', 'idUser'];
    // protected $hidden   = ['created_at', 'updated_at'];
    public function Problematic(){
        return $this->belongsTo('App\Problematic', 'idCommentary');
    }

    public function user(){
        return $this->belongsTo('App\User', 'idCommentary');
    }
}
