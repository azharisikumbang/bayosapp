<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $appends = [
        'order_date'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    protected function orderDate() : Attribute
    {
        return Attribute::make(fn() => (new \DateTimeImmutable($this->created_at))->format('d/m/Y H:i:s'));
    }
}
