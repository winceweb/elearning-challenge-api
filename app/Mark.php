<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model{
    protected $primaryKey = 'idMark';
    protected $table = 'Mark';
    protected $fillable = ['value', 'idUser', 'idProblematic'];
    // protected $hidden   = ['created_at', 'updated_at'];
}
