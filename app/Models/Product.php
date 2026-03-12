<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'original_price',
        'offer_price',
        'image',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Calculate discount percentage
    public function getDiscountPercentage()
    {
        if ($this->original_price && $this->offer_price && $this->original_price > 0) {
            return round(($this->original_price - $this->offer_price) / $this->original_price * 100);
        }
        return 0;
    }

    // Get the final price to display
    public function getFinalPrice()
    {
        return $this->offer_price ?? $this->price;
    }
}
