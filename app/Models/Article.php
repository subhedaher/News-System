<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function status_articles()
    {
        return $this->hasMany(Status_Articles::class, 'article_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id', 'id');
    }

    public function writer()
    {
        return $this->belongsTo(Writer::class, 'writer_id', 'id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
