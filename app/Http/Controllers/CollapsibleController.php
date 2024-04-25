<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollapsibleRequest;
use App\Http\Requests\tt01;
use App\Models\Collapsible;
use App\Models\Soldered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollapsibleController extends Controller
{
    public function index(Request $request)
    {
        $reqs = $request->all();

        $validColumns = ['Brand', 'Model', 'HC', 'VC', 'width', 'height', 'DU'];

        $stringColumns = ['Brand', 'Model', 'DU'];

        $sortedRecords = DB::table('collapsible')->orderBy('Brand');

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

        $recordsWithFiles = $sortedRecords->get()->map(function ($item) {
            $item->files = DB::table('collapsible_files')->where('collapsible_id', $item->id)->get();

            return $item;
        });

        return response()->json($recordsWithFiles);
    }

    public function show(int $id)
    {
        $pipe = Collapsible::findOrFail($id);

        $pipe->files = DB::table('collapsible_files')->where('collapsible_id', $id)->get();

        return response()->json($pipe);
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
