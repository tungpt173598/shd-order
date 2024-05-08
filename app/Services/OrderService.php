<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class OrderService extends BaseService
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        return $this->model->latest()->get();
    }
}
