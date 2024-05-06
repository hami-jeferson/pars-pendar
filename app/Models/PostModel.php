<?php

namespace App\Models;

use App\Enum\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class PostModel extends Model
{
    use HasFactory, HasPersianSlug;
    protected $table = Table::POST->value;

    protected $fillable = ['title', 'content', 'user_id', 'slug'];

    public function scopePostId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopePostSlug($query, $slug)
    {
        return $query->where('id', $slug);
    }

    public function comment()
    {
        return $this->hasMany(CommentModel::class, 'post_id');
    }

    public function feedback()
    {
        return $this->hasMany(FeedbackModel::class, 'post_id');
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
