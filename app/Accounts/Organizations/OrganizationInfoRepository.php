<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseRepository;
use AllAccessRMS\Accounts\Organizations\OrganizationInfo;

class OrganizationInfoRepository extends BaseRepository {

    public function __construct()
    {
        $organizationInfo = new OrganizationInfo();
        parent::__construct($organizationInfo);
    }

}