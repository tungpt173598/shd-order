<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class BaseService
{
    protected $model;

    public function getParams($request)
    {
        $fillable = $this->getFillable();
        return $request->only($fillable);
    }

    public function getFillable()
    {
        return $this->model->getFillable();
    }

    public function create($request)
    {
        try {
            $params = $this->getParams($request);
            $this->model->create($params);
            return $this->success();
        } catch (\Exception $exception) {
            return $this->error();
        }

    }

    public function update($id, $request)
    {
        $params = $this->getParams($request);
        $object = $this->model->findOrFail($id);
        foreach ($params as $key => $value) {
            $object->{$key} = $value;
        }
        try {
            $object->save();
            return $this->success();
        } catch (\Exception $exception) {

            return $this->error();
        }

    }

    public function getTotalRow($query)
    {
        return DB::table(DB::raw("({$query->toSql()}) as count"))
            ->mergeBindings($query->getQuery())
            ->get()
            ->count();
    }

    /**
     * @method formatItems
     * Overwrite this method to modify data
     * @param $items
     * @return mixed*/
    final function formatItems($items)
    {
        return $items;
    }

    public function basePaginate($query, $request, $format = 'formatItems')
    {
        $page = isset($request->page) ? intval($request->page) : 1;
        $perPage = isset($request->size) ? intval($request->size) : 10;
        $skip = $page === 1 ? 0 : ($perPage * ($page - 1));
        $totalRow = $this->getTotalRow($query);
        $totalPage = ceil($totalRow / $perPage);
        $items = $query->skip($skip)->take($perPage)->get();
        $items = $this->{$format}($items);
        return [
            'records' => $items,
            'totalRow' => $totalRow,
            'totalPage' => $totalPage,
            'currentPage' => $page,
            'limitFrom' => count($items) ? $skip + 1 : 0,
            'limitTo' => $skip + count($items)
        ];
    }

    public function index($request, $fieldOrderBy = 'created_at', $typeOrderBy = 'DESC')
    {
        $table = $this->model->getTable();

        return $this->basePaginate($this->model->orderBy("{$table}.{$fieldOrderBy}", "{$typeOrderBy}"), $request);
    }

    public function insert($datas)
    {
        return $this->model->insert($datas);
    }

    public function delete($id)
    {
        try {
            $this->model->findOrFail($id)->delete();
            return $this->success();
        } catch (\Exception $exception) {
            return $this->error();
        }
    }

    protected function success($data = [])
    {
        return [
            'status' => Response::HTTP_OK,
            'messages' => ['Success'],
            'data' => $data
        ];
    }

    protected function error($messages = ['Có lỗi xảy ra, vui lòng tải lại trang'], $data = [])
    {
        return [
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'messages' => $messages,
            'data' => $data
        ];
    }

    protected function notFound($messages = ['Not Found'])
    {
        return [
            'status' => Response::HTTP_NOT_FOUND,
            'messages' => $messages,
        ];
    }

    protected function notAllowed($messages = ['Not Allowed'])
    {
        return [
            'status' => Response::HTTP_FORBIDDEN,
            'messages' => $messages
        ];
    }

}
