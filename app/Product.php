<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $table = 'products';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'cat_id',
        'shot_description',
        'full_description'
    ];

}
