<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArkadeRelease extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'version_number', 'user_interface', 'package_filename', 'released_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'released_at',
    ];

    /**
     * Get the downloads for the release.
     */
    public function downloads()
    {
        return $this->hasMany('App\ArkadeDownload');
    }
}
