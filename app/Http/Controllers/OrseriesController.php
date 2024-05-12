<?php

namespace App\Http\Controllers;

use App\Models\Orseries;
use App\Services\UnifiedTablesService\AbstractTableController;

class OrseriesController extends AbstractTableController
{
    public function __construct()
    {
        parent::__construct(new Orseries());
    }
}
