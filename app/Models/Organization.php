<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'org_form', 'org_number', 'address', 'latitude', 'longitude'
    ];

    public function scopeWithAddressLocation($query)
    {
        return $query->whereNotNull('latitude')->whereNotNull('longitude');
    }
}
