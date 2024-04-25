<?php

namespace App\Services;

use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class UploadFileService
{
    private function __construct()
    {}

    public static function proceed($tableName, int $id, $file)
    {

        if (!DB::table($tableName)->where('id', $id)->exists())
            return response()->json(['message' => 'There is no record in table with such id'], 422);


        $filename = Str::random(20) . '_' . $file->getClientOriginalName();

        $file->storeAs('public', $filename);

        DB::table($tableName . '_files')->insert([
            'original_filename' => $file->getClientOriginalName(),
            'filename' => $filename,
            'url' => '/storage/' . $filename,
            $tableName . '_id' => $id
        ]);
    }
}
