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

    public function list($request)
    {
        $search = $request->search;
        $query = $this->model->latest();
        if (!empty($search)) {
            $query->where('code', 'LIKE', '%' . $search . '%')
                ->orWhere('customer', 'LIKE', '%' . $search . '%');
        }
        return $query->get();
    }
}
