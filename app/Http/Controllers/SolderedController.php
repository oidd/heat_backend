<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollapsibleRequest;
use App\Http\Requests\SolderedRequest;
use App\Models\Collapsible;
use App\Models\Soldered;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SolderedController extends AbstractTableController
{
    public function __construct()
    {
        parent::__construct(new Soldered());
    }
}
