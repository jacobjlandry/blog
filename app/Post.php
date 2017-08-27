<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'created_by');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    public function currentPosition()
    {
        return $this->subcategory->posts->pluck('id')->search($this->id);
    }

    public function hasNext()
    {
        if($this->subcategory) {
            if($this->currentPosition() !== false) {
                return $this->currentPosition() < ($this->subcategory->posts->count() - 1);
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function next()
    {
        return $this->subcategory->posts[$this->currentPosition() + 1];
    }

    public function hasPrevious()
    {
        if($this->subcategory) {
            if($this->currentPosition() !== false) {
                return $this->currentPosition() > 0;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function previous()
    {
        return $this->subcategory->posts[$this->currentPosition() - 1];
    }

    public function first()
    {
        return 1;
    }

    public function last() {
        return $this->subcategory->posts->count();
    }

    public function url()
    {
        return "/post/" . $this->slug;
    }
}
