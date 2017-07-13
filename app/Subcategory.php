<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $guarded = ['id'];

    public function posts()
    {
        return $this->hasMany('App\Post')->orderBy('published_at', 'asc');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
