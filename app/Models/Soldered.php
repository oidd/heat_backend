<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Soldered extends Model
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

    public function getAssociatedFiles()
    {
        return DB::table('soldered_files')->where('soldered_id', '=', $this->id)->get();
    }
}
