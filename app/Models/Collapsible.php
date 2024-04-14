<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collapsible extends Model
{
    use HasFactory;

    protected $table = 'collapsible';

    protected $fillable = [
        'brand',
        'model',
        'HC',
        'VC',
        'DU',
        'W',
        'H',
        'notes',
    ];
}
