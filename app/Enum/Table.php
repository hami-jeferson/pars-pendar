<?php
namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

enum Table : string{
    case USER = 'users';
    case POST = 'posts';
    case COMMENT = 'comments';
    case FEEDBACK = 'feedbacks';
    case UPLOAD_IMAGES = 'upload_images';
}
