<?php namespace AllAccessRMS\Core;

use Exception;
use Session;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use AllAccessRMS\Exceptions\InvalidArgumentException;
use AllAccessRMS\Core\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface {
    /**
     * @var Model
     */
    protected $model;

    protected $userId;

    protected $userOrganizationId;

    protected $userParentOrganizationId;

    public function __construct(Model $model)
    {
        if (!$model instanceof Model)
        {
            throw new Exception("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
        $this->setCache();
    }

    private function setCache()
    {
        $this->userId = Session::get('USER_ID');
        $this->userOrganizationId = Session::get('USER_ORGANIZATION_ID');
        $this->userParentOrganizationId = Session::get('USER_PARENT_ORGANIZATION_ID');
    }

    public function save(Model $model)
    {
        return $model->save();
    }

    public function all()
    {
        return $this->model->all();
    }


    public function make(array $attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

   /**
     * @param int $perPage
     * @return mixed
     */
    public function findAllPaginated($perPage = 20)
    {
        return $this->model
                    ->orderBy('id')
                    ->paginate($perPage);
    }

    public function findAllPaginatedSorted($sortby, $order, $perPage = 20)
    {
        return $this->model
                    ->where('id', '!=', 1)
                    ->orderBy($sortby, $order)
                    ->paginate($perPage);
    }

    public function create(array $attributes = [])
    {
        return $this->model->create($attributes);
    }

    
    public function update(array $data, $id, $attribute='id')
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->where('id', '=', $id)->delete();
    }

}