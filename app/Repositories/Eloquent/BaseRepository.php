<?php
namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\EloquentRepositoryInterface;

class BaseRepository implements EloquentRepositoryInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function first()
    {
        return $this->model->first();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        $record->update($data);
        return $record;
    }

    public function updateOrCreate(array $data)
    {
        return $this->model->updateOrCreate($data);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function paginate()
    {
        return $this->model->orderBy('id', 'desc')->paginate(10);
    }

    public function delete($id)
    {
        $this->model->destroy($id);
    }

    public function search($keyword, $rowsPerPage)
    {
        return $this->columns($keyword)->paginate($rowsPerPage);
    }

    public function onlyTrashed($keyword, $rowsPerPage)
    {
        return $this->columns($keyword)->onlyTrashed()->paginate($rowsPerPage);
    }

    public function onlyTrashedById($id)
    {
        return $this->model->onlyTrashed()->where('id', $id)->first();
    }

    public function columns($keyword)
    {
        $columns = Schema::getColumnListing($this->model->getTable());
        return $this->model->where(function ($query) use($columns, $keyword) {
            for ($i = 0; $i < count($columns); $i++){
               $query->orwhere($columns[$i], 'like',  '%' . $keyword .'%');
            }      
       });
    }

    public function getByIds(array $id)
    {
        return $this->model->whereIn('id', $id)->get();
    }
}