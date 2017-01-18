<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentary extends Model{
    protected $primaryKey = 'idCommentary';
    protected $table = 'Commentary';
    protected $fillable = ['description', 'idProblematic', 'idUser'];
    // protected $hidden   = ['created_at', 'updated_at'];
}
