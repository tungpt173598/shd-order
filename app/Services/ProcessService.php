<?php

namespace App\Services;

use App\Models\Machining;

class ProcessService extends BaseService
{
    protected $model;

    public function __construct(Machining $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        return $this->model->latest()->get();
    }
}
