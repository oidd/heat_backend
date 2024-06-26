<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['required','file'],
            'table' => ['required', 'in:soldered,collapsible,orseries,dtseries'],
            'pipe_id' => ['required', 'integer']
        ]);

        if (!DB::table($request->input('table'))->where('id', $request->input('pipe_id'))->exists())
            return response()->json(['message' => 'There is no record in table with such id'], 422);

        $file = $request->file('file');

        $filename = Str::random(20) . '_' . $file->getClientOriginalName();

        $path = $file->storeAs('public', $filename);

        DB::table($request->input('table') . '_files')->insert([
            'original_filename' => $file->getClientOriginalName(),
            'filename' => $filename,
            'url' => '/storage/' . $filename,
            $request->input('table') . '_id' => $request->input('pipe_id')
        ]);

        return response()->json(['path' => $path]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'table' => ['required', 'in:soldered,collapsible,orseries,dtseries'],
            'id' => ['required', 'integer']
        ]);

        $file = DB::table($request->input('table') . '_files')->where('id', $request->input('id'))->first();

        $query = DB::table($request->input('table') . '_files')->delete($request->input('id'));

        if ($query)
            return response()->json(['file' => $file], 200);

        return response()->json(['message' => 'No file with such id'], 400);
    }
}
