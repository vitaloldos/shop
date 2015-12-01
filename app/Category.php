<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'parent_id'
    ];
}
