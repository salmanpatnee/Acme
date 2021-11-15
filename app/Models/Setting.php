<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'site_title',
        'logo',
        'map',
        'address',
        'email',
        'phone',
    ];
    public static function boot()
    {
        parent::boot();

        static::updated(function ($settings) {
            \Cache::forget('settings');
        });
    }
}
