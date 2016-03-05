<?php namespace AllAccessRMS\Core\Utilities;


class Gender
{

    protected $gender = [
        "M" => "Male",
        "F" => "Female"
    ];

    public function all()
    {
        return static::$gender;
    }
}