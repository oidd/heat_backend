<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollapsibleRequest;
use App\Http\Requests\SolderedRequest;
use App\Models\Collapsible;
use App\Models\Soldered;
use Illuminate\Http\Request;

class SolderedController extends Controller
{
    public function index()
    {
        return response()->json(Soldered::all());
    }

    public function show(int $id)
    {
        return response()->json(Soldered::findOrFail($id));
    }

    public function update(int $id, SolderedRequest $request)
    {
        $pipe = Soldered::findOrFail($id);
        $pipe->fill($request->all());
        $pipe->save();

        return response()->json($pipe);
    }

    public function store(SolderedRequest $request)
    {
        $pipe = Soldered::create($request->validated());
        return response()->json($pipe);
    }

    public function destroy(int $id)
    {
        $pipe = Soldered::findOrFail($id);
        if ($pipe->delete())
            return response()->json('', 200);
        return response()->json('', 500);
    }
}
