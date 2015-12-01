<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdDiscount extends Model
{
    protected $table = 'prod_discounts';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'prod_id',
        'discount_id'
    ];
}
