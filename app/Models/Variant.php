<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['variant', 'label', 'sku_order', 'show_at_sku', 'variant_group_id'];

    public function group() 
    {
        return $this->belongsTo(VariantGroup::class, 'variant_group_id');
    }

    public function skus() 
    {
        return $this->belongsToMany(Sku::class);
    }
}
