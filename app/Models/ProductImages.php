<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImages extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'url'];

    private string $storagePath = 'public/product-images/';

    private ?UploadedFile $uploadedFile = null;

    public function product() 
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getImage() : UploadedFile
    {
        return $this->uploadedFile;
    }

    public function imageLocation() : Attribute
    {
        return Attribute::make(
            get: fn($value) => sprintf("%s%s", $this->storagePath, $this->url)
        );
    }

    public function addImage(UploadedFile $file)
    {
        $this->url = sprintf("%s.%s", Str::random(40), $file->getClientOriginalExtension());
        $this->uploadedFile = $file;
        return $this;
    }

    public function saveToDisk() 
    {
        return $this->uploadedFile->storePubliclyAs($this->storagePath, $this->url);
    }
}
