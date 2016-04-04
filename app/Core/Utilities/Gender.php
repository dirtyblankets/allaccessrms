<?php namespace AllAccessRMS\Core\Utilities;


class Gender
{

    protected static $gender = [
        "M" => "Male",
        "F" => "Female"
    ];

    public static function all()
    {
        return static::$gender;
    }
}