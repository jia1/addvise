<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use Traits\Encryptable;

    protected $encryptable = [
        'fb_user_token_long',
    ];

    protected $fillable = [
        'fb_user_token_temp',
        'fb_user_token_long',
        'fb_user_id'
    ];

    public $timestamps = false;
}
