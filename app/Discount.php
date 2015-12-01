<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'percent',
        'quantity'
    ];
}
