<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str; 
use App\Models\Category;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body', 'iframe', 'excerpt', 'category_id', 'published_at', 'user_id'
    ];

    protected $dates = ['published_at'];

    protected static function boot() {

        parent::boot();

        parent::deleting(function($post) {
            $post->tags()->detach();

            $post->photos->each->delete();
        });
    }

    protected static function create(Array $attributes = []) {

        $attributes['user_id'] = Auth()->user()->id;

        $post = static::query()->create($attributes);

        $post->generateUrl();

        return $post;
    }

    public function getRouteKeyName() {
        return 'url';
    }

    public function category() {
    	return $this->belongsTo(Category::class);
    }

    public function tags() {
    	return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query) {
    	$query->whereNotNull('published_at')
    		  ->where('published_at', '<=', Carbon::now() )
    		  ->latest('published_at');
    }

    public function scopeAllowed($query) {

        if ( Auth()->user()->can('view', $this) )
            return $query;

        return $query->where('user_id', auth()->id());
    }

    public function photos() {
        return $this->hasMany(Photo::class);
    }

    public function setTitleAttribute($title) {
        $this->attributes['title'] = $title;
        // $this->attributes['url'] = Str::slug($title);
    }

    public function setCategoryIdAttribute($category) {
        $this->attributes['category_id'] = Category::find($category)
                            ? $category
                            : Category::create(['name' => $category])->id;
    }

    public function syncTags($tags) {

        $tagIds = collect($tags)->map(function($tag) {
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });
        
        $this->tags()->sync($tagIds);
    }

    public function generateUrl() {

        $url = Str::slug($this->title);

        if ( $this->whereUrl($url)->exists() )
            $url = "{$url}-{$this->id}";

        $this->url = $url;
        $this->save();

    }

    public function isPublished() {
        return !is_null($this->published_at) && $this->published_at < today();
    }

    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function viewType($welcome = '') {

        $path = 'layouts.partials';

        if ( $this->photos->count() === 1 )
            return "{$path}.singlePhoto";
        else if ( $this->photos->count() > 1 )
            return $welcome === 'welcome' ? "{$path}.galleryPreview" : "{$path}.carrusel";
        else if ($this->iframe)
            return "{$path}.media";
        else
            return "{$path}.blank";
    }

}
