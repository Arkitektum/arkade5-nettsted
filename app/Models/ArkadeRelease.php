<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ArkadeRelease extends Model
{
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('public', function (Builder $builder) {
            $builder->whereNotNull('released_at')->whereNull('dereleased_at');
        });
    }

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

    /**
     * Get the downloads for the release.
     */
    public function downloads()
    {
        return $this->hasMany('App\Models\ArkadeDownload');
    }
}
