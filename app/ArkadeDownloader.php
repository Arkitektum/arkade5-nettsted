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
        'email', 'wants_news'
    ];

    /**
     * Get the downloads for the downloader.
     */
    public function downloads()
    {
        return $this->hasMany('App\ArkadeDownload');
    }
}
