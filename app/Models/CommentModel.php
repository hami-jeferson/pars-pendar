<?php

namespace App\Models;

use App\Enum\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;
    protected $table = Table::COMMENT->value;
    protected $fillable = ['user_id', 'post_id', 'rate', 'comment'];

    public function scopeUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
