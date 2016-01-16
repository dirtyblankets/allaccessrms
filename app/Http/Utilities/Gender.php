<?php
/**
 * Created by PhpStorm.
 * User: kapchoi
 * Date: 9/5/15
 * Time: 12:29 AM
 */

namespace app\Http\Utilities;


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