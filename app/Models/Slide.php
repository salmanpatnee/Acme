<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'caption',
        'image',
    ];

    public function getBannerUrlAttribute()
    {
        return asset($this->image);
    }

    protected $appends = [
        'bannerUrl',
    ];
}
