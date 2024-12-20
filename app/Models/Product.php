<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'seller_id',
        'name',
        'description',
        'price',
        'category_id',
        'image_url',
        'brand',
        'color',
        'material',
        'size',
        'fit',
        'shoe_type',
        'is_available',
    ];

    /**
     * Get the seller associated with the product.
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Get the category that the product belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the cart items associated with the product.
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews->avg('rating'); // Assuming 'rating' is a column in the reviews table
    }
}
