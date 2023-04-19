<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArkadeDownload extends Model
{
    use HasFactory;

    const CREATED_AT = 'downloaded_at';
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'downloaded_at', 'is_automated'
    ];

    /**
     * Get the Arkade release for the download.
     */
    public function arkadeRelease()
    {
        return $this->belongsTo('App\Models\ArkadeRelease');
    }

    /**
     * Get the Arkade downloader for the download.
     */
    public function arkadeDownloader()
    {
        return $this->belongsTo('App\Models\ArkadeDownloader');
    }

    /**
     * Get the organization for the download.
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
}
