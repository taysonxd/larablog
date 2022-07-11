<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot() {

    	parent::boot();

    	parent::deleting(function($photo) {
    		Storage::disk('public')->delete($photo->url);
    	});
    }
}
