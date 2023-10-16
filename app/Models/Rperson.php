<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rperson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'relationship',
        'date_of_birth',
        'occupation'];
}
