<?php

namespace App\Services;

use App\Models\Deliver;
use App\Models\Machining;

class DeliverService extends BaseService
{
    protected $model;

    public function __construct(Deliver $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        return $this->model->latest()->get();
    }
}
