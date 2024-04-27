<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collapsible extends Table
{
    use HasFactory;

    protected $table = 'collapsible';

    public function getParams(): array
    {
        return [
            'Brand' => ['string'],
            'Model' => ['string'],
            'HC' => ['numeric'],
            'VC' => ['numeric'],
            'width' => ['numeric'],
            'height' => ['numeric'],
            'DU' => ['string'],
            'Notes' => ['string'],
        ];
    }

    public function getNecessaryParams(): array
    {
        return [
            'Brand', 'Model',
        ];
    }
}
