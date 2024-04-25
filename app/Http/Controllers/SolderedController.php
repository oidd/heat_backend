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

        $validColumns = ['Brand', 'Model', 'HC', 'VC', 'width', 'height', 'Connection', 'Bar', 'Notes'];

        $stringColumns = ['Brand', 'Model', 'Connection', 'Bar', 'Notes'];

        $sortedRecords = DB::table('soldered');

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
                $whereClauses[] = [$k, 'ILIKE', '%' . $v . '%'];
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

        $recordsWithFiles = $sortedRecords->get()->map(function ($item) {
            $item->files = DB::table('soldered_files')->where('soldered_id', $item->id)->get();

            return $item;
        });

        if (empty($whereClauses) && empty($orderByClauses)) {
            return response()->json($recordsWithFiles->sortBy('Brand')->values());
        }

        return response()->json($recordsWithFiles);
    }

    public function show(int $id)
    {
        $pipe = Soldered::findOrFail($id);

        $pipe->files = DB::table('soldered_files')->where('soldered_id', $id)->get();

        return response()->json($pipe);
    }

    public function update(int $id, SolderedRequest $request)
    {
        $pipe = Soldered::findOrFail($id);
        $pipe->fill($request->validated());
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
