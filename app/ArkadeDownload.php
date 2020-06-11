<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArkadeDownload extends Model
{
    const CREATED_AT = 'downloaded_at';
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'downloaded_at'
    ];

    /**
     * Get the Arkade release for the download.
     */
    public function arkadeRelease()
    {
        return $this->belongsTo('App\ArkadeRelease');
    }

    /**
     * Get the user for the download.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the organization for the download.
     */
    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }
}
