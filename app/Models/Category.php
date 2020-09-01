<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    /**
     * The relation to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    protected $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'slug', 'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */
    protected $hidden = [ 'translations' ];

    /**
     * The attributes that should be cast for native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];


}
