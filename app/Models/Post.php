<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $with = ['user','category','photos'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // public function getTitleAttribute($value){
    //     return Str::words($value, 5);
    // }

    public function getShortTitleAttribute()
    {
        return Str::words($this->attributes['title'], 5);
    }

    public function getShowTimeAttribute()
    {
        return "<p class='small mb-0'>
                    <i class='fas fa-calendar'></i>
                     ".$this->created_at->format('Y-m-d')."
                </p>
                <p class='mb-0 small'>
                    <i class='fas fa-clock'></i>
                     ".$this->created_at->format('H:i a')."
                </p>";
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

     //query scope -> local scope
    public function scopeSearch($query)
    {
        if(isset(request()->search)){
            $search = request()->search;
            return $query->where('title',"LIKE","%$search%")->orWhere('description',"LIKE","%$search%");
        }
    }


}
