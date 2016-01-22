<?php namespace AllAccessRMS\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

use Exception;

abstract class BaseRepository  {
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        if (!$model instanceof Model)
        {
            throw new Exception("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
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

    /*
    public function create(array $attributes = [])
    {
        $class = $this->make($attributes);

        try 
        {
            if ($class->save($attributes))
            {
                return $class;
            }

            return false;

        } 
        catch (QueryException $e) 
        {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    public function update(array $data, $id, $attribute='id')
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->where('id', '=', $id)->delete();
    }
    */

}