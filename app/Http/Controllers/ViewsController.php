<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function index()
    {

        $type = ProductType::TYPE;
        $view = view('price.' . $type[request()->type - 1])->render();
        return response()->json(['views' => $view]);
    }
}
