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
            $query->where(function ($q) use ($year) {
                $q->whereYear('created_at', $year)->orWhereYear('delivery_date', $year);
            });
            if ($month > 0) {
                $query->where(function ($q) use ($month) {
                    $q->whereMonth('created_at', $month)->orWhereMonth('delivery_date', $month);
                });
                if (!empty($day) && $day > 0) {
                    $query->where(function ($q) use ($year, $month, $day) {
                        $q->whereDate('created_at', "$year-$month-$day")->orWhereDate('delivery_date', "$year-$month-$day");
                    });
                }
            }
        }
        return $query->paginate(10);
    }
}
