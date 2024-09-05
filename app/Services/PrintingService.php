<?php

namespace App\Services;

use App\Models\PaperSupplier;
use App\Models\PrintingHouse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PrintingService extends BaseService
{
    protected $model;

    public function __construct(PrintingHouse $model)
    {
        $this->model = $model;
    }

    public function list()
    {
        return $this->model->latest()->get();
    }
}
