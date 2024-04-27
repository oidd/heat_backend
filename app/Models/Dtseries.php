<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtseries extends Table
{
    use HasFactory;

    protected $table = 'dtseries';

    protected $hidden = ['created_at', 'updated_at'];


    public function getParams(): array
    {
        return [
            'model' => ['string'],
            'a' => ['numeric'],
            'c' => ['numeric'],
            'd' => ['numeric'],
            'e' => ['numeric'],
            'g' => ['numeric'],
            'h' => ['numeric'],
            'j' => ['numeric'],
            'k' => ['numeric'],
            'l' => ['numeric'],
            'm' => ['numeric'],
            'n' => ['string'],
            'p' => ['numeric'],
            'q' => ['numeric'],
            'r' => ['numeric'],
            's' => ['string'],
            't' => ['string'],
            'max_flow' => ['numeric'],
            'brass_area' => ['numeric'],
            'Notes' => ['string'],
        ];
    }

    public function getNecessaryParams(): array
    {
        return ['model'];
    }
}
