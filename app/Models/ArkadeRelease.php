<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArkadeRelease extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'version_number', 'user_interface', 'package_filename', 'released_at', 'dereleased_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'released_at' => 'datetime',
        'dereleased_at' => 'datetime',
    ];

    public function scopeIsReleased($query){
        return $query->whereNotNull('released_at');
    }

    /**
     * Get the downloads for the release.
     */
    public function downloads()
    {
        return $this->hasMany('App\Models\ArkadeDownload');
    }
}
