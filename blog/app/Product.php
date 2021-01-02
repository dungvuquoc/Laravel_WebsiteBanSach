<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use SoftDeletes;
    use Sortable;
    public function products()
    {
        return $this->hasOne('App\Product');
    }

    protected $guarded = [];
    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function tags() {
        return $this
            ->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')
            ->withTimestamps();
    }

    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public $sortable = ['id', 'name', 'price', 'feature_image_path', 'category_id'];
}
