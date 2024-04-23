<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collapsible extends Model
{
    use HasFactory;

    protected $table = 'collapsible';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'Brand',
        'Model',
        'HC',
        'VC',
        'DU',
        'width',
        'height',
        'Notes',
    ];
}
