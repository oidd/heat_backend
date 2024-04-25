<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollapsibleRequest;
use App\Http\Requests\SolderedRequest;
use App\Models\Collapsible;
use App\Models\Soldered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SolderedController extends Controller
{
    public function index(Request $request)
    {
        $reqs = $request->all();

        $validColumns = ['Brand', 'Model', 'HC', 'VC', 'width', 'height', 'Connection', 'Bar'];

        $stringColumns = ['Brand', 'Model', 'Connection', 'Bar'];

        $sortedRecords = DB::table('soldered')->orderBy('Brand');

        foreach ($reqs as $k => $v)
        {
            if (!in_array($k, $validColumns))
                return response()->json(['message' => 'wrong column to sort by'], 400);

            if (!in_array($k, $stringColumns))
            {
                $v = floatval($v);
                $selectByClauses[] = DB::raw('"' . $k . '" - ' . $v . ' AS ' . $k . '_difference');
                $orderByClauses[] = 'ABS("' . $k . '" - ' . $v .')';
            }
            else
            {
                $whereClauses[] = [$k, 'LIKE', '%' . $v . '%'];
            }
        }

        if (!empty($whereClauses)) {
            foreach ($whereClauses as $clause)
                $sortedRecords = $sortedRecords->where(...$clause);
        }

        if (!empty($orderByClauses)) {
            $sortedRecords = $sortedRecords
                ->select('*', ...$selectByClauses)
                ->orderByRaw(implode(',', $orderByClauses));
        }

        //decide sign that _difference should have


        return response()->json($sortedRecords->get());
    }

    public function show(int $id)
    {
        return response()->json(Soldered::findOrFail($id));
    }

    public function update(int $id, Request $request)
    {
        $pipe = Soldered::findOrFail($id);
        $pipe->fill($request->input());
        $pipe->save();

        return response()->json($pipe);
    }

    public function store(Request $request)
    {
        $pipe = Soldered::create($request->input());
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
