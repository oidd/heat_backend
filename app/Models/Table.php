<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Table extends Model
{
    public function __construct()
    {
        parent::__construct();

        $this->setFillable();
    }

    protected function setFillable(): void
    {
        $this->fillable = array_keys($this->getParams());
    }

    public abstract function getParams(): array;
    public abstract function getNecessaryParams(): array;

    protected $hidden = ['created_at', 'updated_at'];
}
