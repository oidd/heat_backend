<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtseries extends Model
{
    use HasFactory;

    protected $table = 'dtseries';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['model', 'a', 'c', 'd', 'e', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'max_flow', 'brass_area', 'Notes'];
}
