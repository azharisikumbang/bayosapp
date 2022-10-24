<?php

namespace App\Models;

use App\Models\Variant;
use TheSeer\Tokenizer\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sku extends Model
{
    use HasFactory;

    const FORMAT = "BYS-%s-%s-%s-%s-%s"; // {MERK}-{KATEGORI}-{UKURAN}-{WARNA}-{NOMOR_UNIT}

    const MERK = 'BYS';

    protected $fillable = ['value', 'additional_price', 'quantity', 'discount', 'stock_number'];

    public function product() 
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variants() 
    {
        return $this->belongsToMany(Variant::class, 'variant_sku');
    }

    public function generateSkuValue(Product $product, array|Collection|Variant $variant) : self
    {
        $variants = [];
        if (is_array($variant) || $variant instanceof Collection) {
            foreach ($variant as $v) {
                if (!($v instanceof Variant)) throw new Exception("Invalid Variant");

                $variants[] = $v;
            }
        }

        $ukuran = "";
        $warna = "";
        foreach ($variants as $var) {
            if (!in_array(strtolower($var->group->name), ['ukuran', 'warna'])) continue;
            if (strtolower($var->group->name) == 'ukuran') {
                $ukuran = $var->label;
                continue;
            };

            if (strtolower($var->group->name) == 'warna') {
                $warna = $var->label;
                continue;
            };
        }

        // {MERK}-{KATEGORI}-{UKURAN}-{WARNA}-{NOMOR_UNIT}
        $this->value = sprintf("%s-%s-%s-%s", self::MERK, $product->label, $ukuran, $warna);
        $latestSkuStockNumber = Sku::where('value', $this->value)->first();
        $this->stock_number = (!is_null($latestSkuStockNumber)) ? $latestSkuStockNumber->stock_number + 1 : 1;

        return $this;
    }
}
