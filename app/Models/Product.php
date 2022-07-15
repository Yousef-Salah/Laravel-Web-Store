<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Helper\ImageUrlAccessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ImageUrlAccessor;

    protected $fillable = [
        'name', 'slug', 'description', 'category_id', 'price', 'compare_price', 'cost',
        'quantity', 'availability', 'status', 'image', 'sku', 'barcode'
    ];

    // protected $with = [  // get the realtion every time with any form of query. 
    //     'category'
    // ];

    protected static function booted()
    {
        /*  Model Events =>
        creating, created, updating, updated, saving, saved
        deleting, deleted, restoring, resotred, forceDeleting, forceDeleted
        */
        static::forceDeleted(function($product) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
        });

        static::saving(function($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    // Inverse One-To-Many
    // Product belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
        // return $this->belongsTo(Category::class);
    }

    public static function statusOptions()
    {
        return [
            'active' => 'Active',
            'draft' => 'Draft',
            'archived' => 'Archived',
        ];
    }

    public static function availabilities()
    {
        return [
            'in-stock' => 'In Stock',
            'out-of-stock' => 'Out of Stock',
            'back-order' => 'Back-Order'
        ];
    }

    public function getDiscountPercentAttribute()
    {
        if(!$this->compare_price) {
            return 0;
        }

        return number_format($this->price / $this->compare_price * 100, 1);
    }
}
