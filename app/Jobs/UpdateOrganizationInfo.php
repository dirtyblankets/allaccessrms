<?php namespace AllAccessRMS\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Jobs\Job;
use AllAccessRMS\Accounts\Organizations\OrganizationInfo;
use AllAccessRMS\Accounts\Organizations\OrganizationRepository;
use AllAccessRMS\Accounts\Organizations\OrganizationInfoRepository;

class UpdateOrganizationInfo extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $request;

    protected $organizationId;

    public function __construct($request, $organizationId)
    {
        $this->request = $request;

        $this->organizationId = $organizationId;

    }

    public function handle()
    {
        $organizationRepo = new OrganizationRepository();
        $organizationInfoRepo = new OrganizationInfoRepository();

        $organization = $organizationRepo->findById($this->organizationId);
        $orgInfo = $organization->info()->first();


        $orgData = array(
            'name'  =>  $this->request->input('name'),
        );

        $orgInfoData = array(
            'email'     =>  $this->request->input('email'),
            'address'   =>  $this->request->input('address'),
            'city'      =>  $this->request->input('city'),
            'state'     =>  $this->request->input('state'),
            'zipcode'   =>  $this->request->input('zipcode'),
            'telephone' =>  $this->request->input('telephone'),
        );

        $organization->update($orgData);

        $orgInfo->update($orgInfoData);

    }
}