<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollapsibleRequest;
use App\Http\Requests\tt01;
use App\Models\Collapsible;
use Illuminate\Http\Request;

class CollapsibleController extends Controller
{
    public function index()
    {
        return response()->json(Collapsible::all());
    }

    public function show(int $id)
    {
        return Collapsible::findOrFail($id);
    }

    public function update(int $id, CollapsibleRequest $request)
    {
        $pipe = Collapsible::findOrFail($id);
        $pipe->fill($request->all());
        $pipe->save();

        return response()->json($pipe);
    }

    public function store(Request $request)
    {
        $pipe = Collapsible::create($request->input());
        return response()->json($pipe);
    }

    public function destroy(int $id)
    {
        $pipe = Collapsible::findOrFail($id);
        if ($pipe->delete())
            return response()->json('', 200);
        return response()->json('', 500);
    }

}
