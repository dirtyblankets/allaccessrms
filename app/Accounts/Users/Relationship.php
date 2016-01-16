<?php namespace AllAccessRMS\Accounts\Users;

trait Relationship
{
    public function organization()
    {
        return $this->belongsTo('AllAccessRMS\Accounts\Organizations\Organization');
    }
}