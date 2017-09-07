<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdviceGiven extends Model
{
    protected $table = 'advice_given';

    protected $fillable = [
        'is_anonymous',
        'fb_comment_id',
        'fb_post_id',
        'fb_user_id',
    ];

    public $timestamps = false;
}
