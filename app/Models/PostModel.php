<?php

namespace App\Models;

use App\Enum\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;
    protected $table = Table::POST->value;

    protected $fillable = ['title', 'content', 'user_id'];
}
