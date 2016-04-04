<?php namespace AllAccessRMS\Core\Utilities;

class Languages {

    public static function all()
    {
        return static::$languages;
    }

    protected static $languages = array(
        'ENG'=>'English',
        'KOR'=>'Korean',
        'SPN'=>'Spanish',
    );
}