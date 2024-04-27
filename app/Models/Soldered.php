<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Soldered extends Table
{
    use HasFactory;

    protected $table = 'soldered';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'Brand',
        'Model',
        'HC',
        'VC',
        'width',
        'height',
        'Connection',
        'Bar',
        'Notes',
    ];

    public function getParams(): array
    {
        return [
            'Brand' => ['string'],
            'Model' => ['string'],
            'HC' => ['numeric'],
            'VC' => ['numeric'],
            'width' => ['numeric'],
            'height' => ['numeric'],
            'Connection' => ['string'],
            'Bar' => ['string'],
            'Notes' => ['string'],
        ];
    }

    public function getNecessaryParams(): array
    {
        return ['Brand', 'Model'];
    }
}
