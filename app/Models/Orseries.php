<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orseries extends Table
{
    use HasFactory;

    protected $table = 'orseries';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['model', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'pipes_count', 'pipe_area', 'volume', 'pump_flow', 'water_consumption', 'Notes'];

    public function getParams(): array
    {
        return [
            'model' => ['string'],
            'a' => ['numeric'],
            'b' => ['numeric'],
            'c' => ['numeric'],
            'd' => ['numeric'],
            'e' => ['numeric'],
            'f' => ['string'],
            'g' => ['string'],
            'pipes_count' => ['numeric'],
            'pipe_area' => ['numeric'],
            'volume' => ['numeric'],
            'pump_flow' => ['numeric'],
            'water_consumption' => ['numeric'],
            'Notes' => ['string'],
        ];
    }

    public function getNecessaryParams(): array
    {
        return ['model'];
    }
}
