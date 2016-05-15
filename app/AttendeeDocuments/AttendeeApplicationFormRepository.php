<?php namespace AllAccessRMS\AttendeeDocuments;

use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Core\BaseRepository;

class AttendeeApplicationFormRepository extends BaseRepository {

	public function __construct(AttendeeApplicationForm $appForm)
    {
        parent::__construct($appForm);
    }
}