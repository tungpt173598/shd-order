<?php

namespace App\Services;

use App\Models\Machining;
use App\Models\Pack;

class PackService extends BaseService
{
    protected $model;

    public function __construct(Pack $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        return $this->model->latest()->get();
    }
}
