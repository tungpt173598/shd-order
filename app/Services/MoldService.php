<?php

namespace App\Services;

use App\Models\Machining;
use App\Models\Mold;
use App\Models\Pack;

class MoldService extends BaseService
{
    protected $model;

    public function __construct(Mold $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        return $this->model->latest()->get();
    }
}
