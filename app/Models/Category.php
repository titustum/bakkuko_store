<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Define the fillable fields to allow mass assignment
    protected $fillable = ['name', 'image_url'];

    /**
     * Get the products associated with the category.
     */
    public function products()
    {
        // Define the relationship with the Product model
        return $this->hasMany(Product::class);
    }
}
