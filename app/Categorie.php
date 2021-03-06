<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
     use SoftDeletes;
     protected $dates = ['deleted_at'];

    protected $fillable = [
    	'nom','	small_description','full_description','photo'
    ];	
}
