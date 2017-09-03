<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdviceRequest extends Model
{
    protected $fillable = [
        'label',
        'fb_post_id',
        'fb_user_id',
    ];

    public $timestamps = false;
}
