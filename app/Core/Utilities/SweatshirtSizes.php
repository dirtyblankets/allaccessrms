<?php namespace AllAccessRMS\Core\Utilities;

class SweatshirtSizes {

    public static function all()
    {
        return static::$sweatshirt_sizes;
    }

    protected static $sweatshirt_sizes = array(
    	''		=>	'',
        'xs'    =>  'extra small',
        'sm'    =>  'small',
        'md'    =>  'medium',
        'lg'    =>  'large',
        'xl'   =>  'extra large',
        '2xl'  =>  'extra-extra large',
    );
}