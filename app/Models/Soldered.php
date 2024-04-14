<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Soldered extends Model
{
    use HasFactory;

    protected $table = 'soldered';

    protected $fillable = [
        'brand',
        'model',
        'A',
        'B',
        'C',
        'D',
        'connection',
        'bar',
        'notes',
    ];

    public function getAssociatedFiles()
    {
        return DB::table('soldered_files')->where('soldered_id', '=', $this->id)->get();
    }
}
