<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orseries extends Model
{
    use HasFactory;

    protected $table = 'orseries';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['model', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'pipes_count', 'pipe_area', 'volume', 'pump_flow', 'water_consumption', 'Notes'];
}
