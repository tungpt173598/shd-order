<?php

namespace App\Http\Controllers;

use App\Services\PaperSupplierService;
use App\Traits\BaseResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'name' => 'bail|required|unique:paper_suppliers,name|max:255',
            'phone' => 'bail|nullable|numeric|digits_between:9,11',
            'address' => 'nullable|max:255'
        ]);
        if ($validator->fails()) {
            return $this->errorParams($validator->errors()->all());
        }
        $result = $this->service->create($request);
        return $this->baseResponse($result);
    }
}
