<?php namespace AllAccessRMS\Core\Utilities;

class Grades {

    public static function all()
    {
        return static::$grades;
    }

    protected static $grades = array(
        ''=>'',
        '6'=>'6th',
        '7'=>'7th',
        '8'=>'8th',
        '9'=>'9th',
        '10'=>'10th',
        '11'=>'11th',
        '12'=>'12th',
        'U+'=>'College',
    );
}