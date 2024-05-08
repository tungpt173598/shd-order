<?php

namespace App\Http\Controllers;

use App\Models\Deliver;
use App\Models\Design;
use App\Models\Machining;
use App\Models\Order;
use App\Models\Pack;
use App\Models\PaperSupplier;
use App\Models\PrintingHouse;
use App\Services\OrderService;
use App\Traits\BaseResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use BaseResponse;
    protected $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->list();
        $select = [
            'papers' => PaperSupplier::pluck('name', 'id')->toArray(),
            'designs' => Design::pluck('name', 'id')->toArray(),
            'prints' => PrintingHouse::pluck('name', 'id')->toArray(),
            'packs' => Pack::pluck('name', 'id')->toArray(),
            'machining' => Machining::pluck('name', 'id')->toArray(),
            'delivers' => Deliver::pluck('name', 'id')->toArray(),
        ];
        return view('order', compact('data', 'select'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required'
        ], [
            'code.required' => 'Mã đơn không được trống'
        ]);
        if ($validator->fails()) {
            return $this->errorParams($validator->errors()->all());
        }
        if ($request->pre_charge > $request->price) {
            return $this->errorParams(['Tiền tạm ứng không được lớn hơn giá']);
        }

        if ($request->payment_type == 2) {
            $request->merge(['pre_charge' => 0]);
        }
        $result = $this->service->create($request);
        return $this->baseResponse($result);
    }

    public function detail($id)
    {
        $item = Order::findOrFail($id);
        return $this->success($item);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required'
        ], [
            'code.required' => 'Mã đơn không được trống'
        ]);
        if ($validator->fails()) {
            return $this->errorParams($validator->errors()->all());
        }
        if ($request->payment_type == 2) {
            $request->merge(['pre_charge' => 0]);
        }
        if ($request->payment_type == 1 && $request->pre_charge > $request->price) {
            return $this->errorParams(['Tiền tạm ứng không được lớn hơn giá']);
        }
        $result = $this->service->update($id, $request);
        return $this->baseResponse($result);
    }

    public function delete($id)
    {
        $result = $this->service->delete($id);
        return $this->baseResponse($result);
    }
}