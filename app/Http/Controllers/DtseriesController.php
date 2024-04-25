<?php

namespace App\Http\Controllers;


use App\Http\Requests\DtseriesRequest;
use App\Models\Dtseries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DtseriesController extends Controller
{
    public function index(Request $request)
    {
        $reqs = $request->all();

        $validColumns = ['model', 'a', 'c', 'd', 'e', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'max_flow', 'brass_area', 'Notes'];

        $stringColumns = ['model', 'n', 's', 't', 'Notes'];

        $sortedRecords = DB::table('dtseries');

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
            $item->files = DB::table('dtseries_files')->where('dtseries_id', $item->id)->get();

            return $item;
        });

        if (empty($whereClauses) && empty($orderByClauses)) {
            return response()->json($recordsWithFiles->sortBy('model')->values());
        }

        return response()->json($recordsWithFiles);
    }

    public function show(int $id)
    {
        $pipe = Dtseries::findOrFail($id);

        $pipe->files = DB::table('dtseries_files')->where('dtseries_id', $id)->get();

        return response()->json($pipe);
    }

    public function update(int $id, DtseriesRequest $request)
    {
        $pipe = Dtseries::findOrFail($id);
        $pipe->fill($request->validated());
        $pipe->save();

        return response()->json($pipe);
    }

    public function store(DtseriesRequest $request)
    {
        $pipe = Dtseries::create($request->validated());

        return response()->json($pipe);
    }

    public function destroy(int $id)
    {
        $pipe = Dtseries::findOrFail($id);
        if ($pipe->delete())
            return response()->json('', 200);
        return response()->json('', 500);
    }
}
