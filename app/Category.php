<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $primaryKey = 'idCategory';
 	protected $fillable = ['title'];
  protected $table = 'Category';

  public function lessons(){
      return $this->hasMany('App\Lesson', 'idCategory');
  }
}
