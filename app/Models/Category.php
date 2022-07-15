<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Helper\ImageUrlAccessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Scopes\MainCategoryScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ImageUrlAccessor;

    protected $fillable = [
        'name', 'slug', 'parent_id', 'description', 'image',
    ];

    // protected $guarded = [];

    protected static function booted()
    {
        //static::addGlobalScope(new MainCategoryScope());

        // static::addGlobalScope('parent-name', function(Builder $builder) {
        //     $builder->leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
        //         ->select([
        //             'categories.*',
        //             'parents.name as parent_name'
        //         ]);
        // });
        static::forceDeleted(function($category) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
        });

        static::saving(function($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    //Relations
    // One-To-Many: One Category Has Many Products
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
        // return $this->hasAppended(Product::class);
    }

    public function scopeSearch(Builder $builder, $value)
    {
        if ($value) {
            $builder->where('categories.name', 'LIKE', "%{$value}%");
        }
    }

    public function scopeParent(Builder $builder, $parent_id)
    {
        $builder->where('categories.parent_id', '=', $parent_id);
    }
}
