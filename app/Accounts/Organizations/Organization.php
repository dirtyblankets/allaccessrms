<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseModel;

class Organization extends BaseModel
{
    use Relationship;

	protected $table = 'organizations';

	protected $fillable = ['name'];

    protected static $rules = array(
        'name'  =>  'required'
    );


    /*
    public function ownersEmail()
    {
        return $this->users();
    }
    */

}