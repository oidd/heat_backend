<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollapsibleRequest;
use App\Models\Collapsible;
use App\Models\Soldered;
use App\Models\Table;
use App\Services\UploadFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollapsibleController extends AbstractTableController
{
    public function __construct()
    {
        parent::__construct(new Collapsible());
    }
}
