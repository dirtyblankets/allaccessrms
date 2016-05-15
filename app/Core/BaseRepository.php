<?php namespace AllAccessRMS\Core;

use Auth;
use Exception;
use Session;


use Illuminate\Database\QueryException;
use AllAccessRMS\Exceptions\InvalidArgumentException;
use AllAccessRMS\Core\BaseModel;
use AllAccessRMS\Core\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface {
    /**
     * @var Model
     */
    protected $model;

    protected $userId;

    protected $userOrganizationId;

    protected $userParentOrganizationId;

    public function __construct(BaseModel $model)
    {
        if (!$model instanceof BaseModel)
        {
            throw new Exception("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
        $this->setContextInfo();
    }

    private function setContextInfo()
    {
        if (Auth::check())
        {
            $this->userId = Auth::user()->id;
            $this->userOrganizationId = Auth::user()->organization_id;

            if (Auth::user()->organization()->first()->isChild())
            {
                $this->userParentOrganizationId = Auth::user()->organization()->first()->parent()->first()->id; 
            }
            else
            {
                $this->userParentOrganizationId = null; 
            }           
        }

    }

    
    public function save()
    {
        return $this->model->save();
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