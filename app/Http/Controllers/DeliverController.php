<?php

namespace App\Http\Controllers;

use App\Models\Deliver;
use App\Models\Machining;
use App\Models\Pack;
use App\Services\DeliverService;
use App\Services\PackService;
use App\Services\ProcessService;
use App\Traits\BaseResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DeliverController extends Controller
{
    use BaseResponse;
    protected $service;
    public function __construct(DeliverService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $data = $this->service->list();
        return view('deliver', compact('data'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['bail', 'required', 'max:255', Rule::unique('delivers')],
            'phone' => 'bail|nullable|numeric|digits_between:9,11',
            'address' => 'nullable|max:255'
        ], [
            'name.required' => 'Xin hãy nhập tên bên giao hàng',
            'name.unique' => 'Bên giao hàng đã tồn tại',
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
        $item = Deliver::findOrFail($id);
        return $this->success($item);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'bail',
                'required',
                'max:255',
                Rule::unique('delivers')->ignore($id)],
            'phone' => 'bail|nullable|numeric|digits_between:9,11',
        ], [
            'name.required' => 'Xin hãy nhập tên bên giao hàng',
            'name.unique' => 'Bên giao hàng đã tồn tại',
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
