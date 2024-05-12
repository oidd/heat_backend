<?php

namespace App\Http\Controllers;

use App\Models\Soldered;
use App\Services\UnifiedTablesService\AbstractTableController;

class SolderedController extends AbstractTableController
{
    public function __construct()
    {
        parent::__construct(new Soldered());
    }
}
