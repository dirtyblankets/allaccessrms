<?php namespace AllAccessRMS\Http\Utilities;


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