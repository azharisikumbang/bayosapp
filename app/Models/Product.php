<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Dotenv\Exception\InvalidFileException;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'thumbnail', 'product_category_id'];

    protected $appends = ['thumbnail_location'];

    private string $IMAGE_LOCATION = 'product-images/';

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function images() 
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function addProductImages(array $images) 
    {
        $listImages = [];
        foreach ($images as $image) {
            if (!$image instanceof UploadedFile) throw new InvalidFileException('Invalid Product Images.');
            
            $productImage = new ProductImages();
            $productImage->addImage($image)->saveToDisk();
            $listImages[] = $productImage;
        }

        $this->images()->saveMany($listImages);

        return $this;
    }

    public function saveThumbnail(UploadedFile $file)
    {
        $this->thumbnail = sprintf("%s.%s", Str::random(40), $file->getClientOriginalExtension());
        $file->storePubliclyAs('public/' . $this->IMAGE_LOCATION, $this->thumbnail);

        return $this;
    }

    public function thumbnailLocation() : Attribute
    {
        return Attribute::make(
            get: fn($value) => sprintf("%s%s", $this->IMAGE_LOCATION, $this->thumbnail)
        );
    }
}
