<?php

namespace App\Services;

use App\Models\PaperSupplier;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PaperSupplierService extends BaseService
{
    protected $model;

    public function __construct(PaperSupplier $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        return $this->model->latest()->get();
    }
}
