<?php namespace AllAccessRMS\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

/**
 * AllAccessRMS\Core\BaseModel
 *
 */
class BaseModel extends Model {

    /**
     * Error message bag
     *
     * @var Illuminate\Support\MessageBag
     */
    protected $errors;
    /**
     * Validation rules
     *
     * @var Array
     */
    protected static $rules = array();
    /**
     * Custom messages
     *
     * @var Array
     */
    protected static $messages = array();
    /**
     * Validator instance
     *
     * @var Illuminate\Validation\Validators
     */
    protected $validator;

    public function __construct(array $attributes = array(), Validator $validator = null)
    {
        $this->validator = $validator ?: \App::make('validator');
        parent::__construct($attributes);
    }
    /**
     * Listen for save event
     */

    protected static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            if ( ! $model->validate() )
            {
                return false;
            }
        });

    }

    /**
     * Validates current attributes against rules
     */
    public function validate()
    {
        $v = $this->validator->make($this->attributes, static::$rules, static::$messages);
        if ($v->passes())
        {
            return true;
        }
        $this->setErrors($v->messages());
        return false;
    }
    /**
     * Set error message bag
     *
     * @var Illuminate\Support\MessageBag
     */
    protected function setErrors($errors)
    {
        $this->errors = $errors;
    }
    /**
     * Retrieve error message bag
     */
    public function getErrors()
    {
        return $this->errors;
    }
    /**
     * Inverse of wasSaved
     */
    public function hasErrors()
    {
        return ! empty($this->errors);
    }

    public function setTelephoneAttribute($telephone)
    {
        $this->attributes['telephone'] = preg_replace("/\D/","",$telephone);
    }

    public function update(array $attributes = [])
    {
        foreach($attributes as $key => $value)
        {
            if(!empty($value))
            {
                $this->{$key} = $value;                
            } 

        }

        return $this->save();
    }
}