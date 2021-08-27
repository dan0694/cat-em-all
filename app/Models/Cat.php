<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function breed() {
        return $this->belongsTo('App\Models\Breed');
    }
    public function image(){
        return $this->hasOne('App\Models\CatImage');
    }
}
