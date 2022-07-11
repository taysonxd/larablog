<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName() {
    	return 'url';
    }

    public function posts() {
    	return $this->hasMany(Post::class);
    }

    public function setNameAttribute($name) {
    	$this->attributes['name'] = $name;
    	$this->attributes['url'] = Str::slug($name);
    }
    
}
