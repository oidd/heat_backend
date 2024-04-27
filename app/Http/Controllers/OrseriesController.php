<?php

namespace App\Http\Controllers;


use App\Http\Requests\OrseriesRequest;
use App\Models\Orseries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrseriesController extends AbstractTableController
{
    public function __construct()
    {
        parent::__construct(new Orseries());
    }
}
