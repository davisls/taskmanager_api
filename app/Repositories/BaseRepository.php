<?php

namespace App\Repositories;

class BaseRepository
{
    protected $obj;

    public function __construct(Object $obj)
    {
        $this->obj = $obj;
    }

    public function index()
    {
        return $this->obj->all();
    }

    public function create(array $request)
    {
        $this->obj->create($request);
    }

    public function search($column, $search)
    {
        return $this->obj->where($column, 'LIKE', "%$search%")->get();
    }

    public function update($id_task, array $request)
    {
        $this->obj->findOrFail($id_task)->update($request);
    }

    public function destroy($id_task)
    {
        $this->obj->findOrFail($id_task)->delete();
    }

    public function findByid($id)
    {
        return $this->obj->find($id);
    }
}
