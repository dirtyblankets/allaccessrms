<?php namespace AllAccessRMS\Core;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface  
{

    public function save();

    public function all();

    public function make(array $attributes = []);

    public function findById($id);

    public function findAllPaginated($perPage = 20);

    public function findAllPaginatedSorted($sortby, $order, $perPage = 20);

    public function create(array $attributes = []);
    
    public function update(array $data, $id, $attribute='id');

    public function delete($id);

}