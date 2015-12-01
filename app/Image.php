<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'prod_id',
        'path'
    ];
}
