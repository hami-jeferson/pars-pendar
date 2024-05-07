<?php

namespace App\Models;

use App\Enum\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackModel extends Model
{
    use HasFactory;
    protected $table = Table::FEEDBACK->value;

    protected $fillable = ['user_id', 'post_id', 'action'];

    public function scopeUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeAction($query, $action)
    {
        return $this->where('action', $action);
    }
}
