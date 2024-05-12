<?php

namespace App\Http\Controllers;

use App\Models\Dtseries;
use App\Services\UnifiedTablesService\AbstractTableController;

class DtseriesController extends AbstractTableController
{
    public function __construct()
    {
        parent::__construct(new Dtseries());
    }
}
