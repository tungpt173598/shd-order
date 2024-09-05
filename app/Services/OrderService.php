<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;
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
            $query->where(function ($query) use ($search) {
                $query->where('code', 'LIKE', '%' . $search . '%')
                    ->orWhere('customer', 'LIKE', '%' . $search . '%');
            });

        }
        $year = is_null($request->year) ? Carbon::now()->year : $request->year;
        $month = is_null($request->month) ? Carbon::now()->month : $request->month;
        $day = $request->day;
        if ($year > 0) {
            $query->whereYear('created_at', $year);
            if ($month > 0) {
                $query->whereMonth('created_at', $month);
                if (!empty($day) && $day > 0) {
                    $query->whereDate('created_at', "$year-$month-$day");
                }
            }
        }
        return $query->get();
    }
}
