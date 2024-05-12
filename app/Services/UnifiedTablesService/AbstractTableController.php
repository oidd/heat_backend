<?php

namespace App\Services\UnifiedTablesService;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class AbstractTableController extends Controller
{
    public function __construct(protected Table $model)
    {}

    protected function updateRules()
    {
        $params = $this->model->getParams();
        $necessaryParam = $this->model->getNecessaryParams();

        foreach ($params as $k => $v)
            if (!in_array($k, $necessaryParam))
                $params[$k][] = 'nullable';

        return $params;
    }

    protected function storeRules()
    {
        $params = $this->model->getParams();
        $necessaryParam = $this->model->getNecessaryParams();

        foreach ($params as $k => $v)
            if (in_array($k, $necessaryParam))
                $params[$k][] = 'required';
            else
                $params[$k][] = 'nullable';

        return $params;
    }

    public function index(Request $request)
    {
        $params = $this->model->getParams();

        $reqs = $request->validate(
            $params
        );

        $sortedRecords = DB::table($this->model->getTable());

        foreach ($reqs as $k => $v)
        {
            if (!in_array('string', $params[$k]))
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
            $item->files = DB::table($this->model->getTable() . '_files')
                ->where($this->model->getTable() . '_id', $item->id)
                ->get();

            return $item;
        });

        if (empty($whereClauses) && empty($orderByClauses)) {
            return response()
                ->json($recordsWithFiles
                    ->sortBy($this->model->getFillable()[0])->values());
        }

        return response()->json($recordsWithFiles);
    }

    public function show(int $id)
    {
        $pipe = $this->model::findOrFail($id);

        $pipe->files = DB::table($this->model->getTable() . '_files')->where($this->model->getTable() . '_id', $id)->get();

        return response()->json($pipe);
    }

    public function update(int $id, Request $request)
    {
        $params = $this->updateRules();

        $reqs = $request->validate(
            $params
        );

        $pipe = $this->model::findOrFail($id);
        $pipe->fill($reqs);
        $pipe->save();

        return response()->json($pipe);
    }

    public function store(Request $request)
    {
        $params = $this->storeRules();

        $reqs = $request->validate(
            $params
        );

        $pipe = $this->model::create($reqs);

        return response()->json($pipe);
    }

    public function destroy(int $id)
    {
        $pipe = $this->model::findOrFail($id);
        if ($pipe->delete())
            return response()->json('', 200);
        return response()->json('', 500);
    }
}
