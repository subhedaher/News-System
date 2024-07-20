<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'content', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }
}
