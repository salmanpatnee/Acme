<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'client',
        'date',
        'url',
        'image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function getCategoriesListAttribute()
    {
        return $this->categories()->pluck('name')->implode(', ');
    }

    public function getImageSrcAttribute()
    {
        return asset($this->image);
    }

    public function getClassesAttribute()
    {
        return $this->categories()->pluck('slug')->map(function ($slug) {
            return "filter-{$slug}";
        })->implode(' ');
    }

    protected $appends = ['categoriesList', 'imageSrc'];
}
