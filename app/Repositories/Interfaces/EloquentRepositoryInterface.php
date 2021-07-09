<?php

namespace App\Repositories\Interfaces;

interface EloquentRepositoryInterface
{
    public function all();

    public function first();

    public function getModel();

    public function create(array $data);

    public function insert(array $data);

    public function update(array $data, $id);

    public function updateOrCreate(array $data);

    public function find($id);

    public function paginate();

    public function delete($id);

    public function search($keyword, $rowsPerPage);

    public function onlyTrashed($keyword, $rowsPerPage);

    public function onlyTrashedById($id);

    public function getByIds(array $id);
}