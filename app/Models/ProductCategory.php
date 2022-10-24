<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'display_name', 'parent'];

    public function parent() 
    {
        return $this->belongsTo(self::class, 'parent');
    }

    public function children() 
    {
        return $this->hasMany(self::class, 'parent');
    }

    public function products() 
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}
