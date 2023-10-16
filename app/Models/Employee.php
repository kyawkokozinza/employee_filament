<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function address(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function work(): HasMany
    {
        return $this->hasMany(WorkExp::class, );
    }

    public function education(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function nrcno(): BelongsTo
    {
        return $this->belongsTo(Nrc::class);

    }

    public function rpeople(): HasMany
    {
        return $this->hasMany(Rperson::class);
    }
    public function fmember(): HasMany
    {
        return $this->hasMany(Fmember::class);
    }

}
