<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_product extends Model
{
    protected $table = 'category_product';

    protected $fillable = [
        'product_category_name',
    ];

    public function get_category_product()
    {
        //get all category_product
        $sql = $this->select("*");
        return $sql;
    }
}
