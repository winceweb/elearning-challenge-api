<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'Rating';
    protected $fillable = ['value', 'rateable_id', 'rateable_type', 'idUser'];
}
