<?php

namespace App\Http\Controllers;


use App\Http\Requests\DtseriesRequest;
use App\Models\Dtseries;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DtseriesController extends AbstractTableController
{
    public function __construct()
    {
        parent::__construct(new Dtseries());
    }
}
