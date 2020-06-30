<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArkadeDownloader extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'has_arkade_v1_experience', 'wants_news'
    ];
}
