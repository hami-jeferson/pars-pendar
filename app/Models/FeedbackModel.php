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
}
