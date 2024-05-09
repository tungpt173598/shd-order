<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaperSupplier;
use App\Services\PaperSupplierService;
use App\Traits\BaseResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaperSupplierController extends Controller
{
    use BaseResponse;
    protected $service;
    public function __construct(PaperSupplierService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $data = $this->service->list();
        return view('paper', compact('data'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['bail', 'required', 'max:255', Rule::unique('paper_suppliers')->whereNull('deleted_at')],
            'phone' => 'bail|nullable|numeric|digits_between:9,11',
            'address' => 'nullable|max:255'
        ], [
            'name.required' => 'Xin hãy nhập tên nhà cung cấp',
            'name.unique' => 'Nhà cung cấp đã tồn tại',
            'phone.digits_between' => 'Xin hãy nhập SĐT từ 9 đến 11 số',
        ]);
        if ($validator->fails()) {
            return $this->errorParams($validator->errors()->all());
        }
        $result = $this->service->create($request);
        return $this->baseResponse($result);
    }

    public function detail($id)
    {
        $item = PaperSupplier::findOrFail($id);
        return $this->success($item);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'bail',
                'required',
                'max:255',
                Rule::unique('paper_suppliers')->whereNull('deleted_at')->ignore($id)],
            'phone' => 'bail|nullable|numeric|digits_between:9,11',
        ], [
            'name.required' => 'Xin hãy nhập tên nhà cung cấp',
            'name.unique' => 'Nhà cung cấp đã tồn tại',
            'phone.digits_between' => 'Xin hãy nhập SĐT từ 9 đến 11 số',
        ]);
        if ($validator->fails()) {
            return $this->errorParams($validator->errors()->all());
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
