<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'product_id',
        'link',
        'order',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
