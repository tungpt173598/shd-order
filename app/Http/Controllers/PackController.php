<?php

namespace App\Http\Controllers;

use App\Models\Machining;
use App\Models\Pack;
use App\Services\PackService;
use App\Services\ProcessService;
use App\Traits\BaseResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PackController extends Controller
{
    use BaseResponse;
    protected $service;
    public function __construct(PackService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $data = $this->service->list();
        return view('pack', compact('data'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['bail', 'required', 'max:255', Rule::unique('packs')],
            'phone' => 'bail|nullable|numeric|digits_between:9,11',
            'address' => 'nullable|max:255'
        ], [
            'name.required' => 'Xin hãy nhập tên bên đóng gói',
            'name.unique' => 'Bên đóng gói đã tồn tại',
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
        $item = Pack::findOrFail($id);
        return $this->success($item);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'bail',
                'required',
                'max:255',
                Rule::unique('packs')->ignore($id)],
            'phone' => 'bail|nullable|numeric|digits_between:9,11',
        ], [
            'name.required' => 'Xin hãy nhập tên bên đóng gói',
            'name.unique' => 'Bên đóng gói đã tồn tại',
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
