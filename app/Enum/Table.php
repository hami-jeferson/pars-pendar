<?php
namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

enum Table : string{
    case USER = 'user';
    case POST = 'posts';
    case COMMENT = 'comments';
    case LIKE = 'likes';
}
