<?php

namespace App\Http\Controllers;


use App\Http\Requests\OrseriesRequest;
use App\Models\Orseries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrseriesController extends Controller
{
    public function index(Request $request)
    {
        $reqs = $request->all();

        $validColumns = ['model', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'pipes_count', 'pipe_area', 'volume', 'pump_flow', 'water_consumption', 'Notes'];

        $stringColumns = ['model', 'f', 'g', 'Notes'];

        $sortedRecords = DB::table('orseries');

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
            $item->files = DB::table('orseries_files')->where('orseries_id', $item->id)->get();

            return $item;
        });

        if (empty($whereClauses) && empty($orderByClauses)) {
            return response()->json($recordsWithFiles->sortBy('model')->values());
        }

        return response()->json($recordsWithFiles);
    }

    public function show(int $id)
    {
        $pipe = Orseries::findOrFail($id);

        $pipe->files = DB::table('orseries_files')->where('orseries_id', $id)->get();

        return response()->json($pipe);
    }

    public function update(int $id, OrseriesRequest $request)
    {
        $pipe = Orseries::findOrFail($id);
        $pipe->fill($request->validated());
        $pipe->save();

        return response()->json($pipe);
    }

    public function store(OrseriesRequest $request)
    {
        $pipe = Orseries::create($request->validated());

        return response()->json($pipe);
    }

    public function destroy(int $id)
    {
        $pipe = Orseries::findOrFail($id);
        if ($pipe->delete())
            return response()->json('', 200);
        return response()->json('', 500);
    }
}
