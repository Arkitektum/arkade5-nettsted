<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArkadeDownloader extends Model
{
    use HasFactory;

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
        return $this->hasMany('App\Models\ArkadeDownload');
    }
}
