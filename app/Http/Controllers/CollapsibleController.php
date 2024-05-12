<?php

namespace App\Http\Controllers;

use App\Models\Collapsible;
use App\Services\UnifiedTablesService\AbstractTableController;

class CollapsibleController extends AbstractTableController
{
    public function __construct()
    {
        parent::__construct(new Collapsible());
    }
}
