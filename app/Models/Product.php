<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Variant;
use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Product extends Model
{
    use HasFactory, FilterQueryString;

    protected $filters = [
        'sort',
        'between',
        'like',
        'sku',
        'category_id',
        'brand'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'attribute' => AsArrayObject::class,
        'dimension' => AsArrayObject::class,
        'img' => AsArrayObject::class
    ];

    public function getPriceAttribute($value): int
    {
        return $this->is_have_variant() ? $value : 0;
    }

    public function is_have_variant(): bool
    {
        return $this->variants->isEmpty();
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class)->select(['id','name']);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->select(['id','name','slug']);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class)->where('is_active', true);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
