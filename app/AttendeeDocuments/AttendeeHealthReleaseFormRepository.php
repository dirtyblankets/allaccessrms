<?php namespace AllAccessRMS\AttendeeDocuments;

use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Core\BaseRepository;

class AttendeeHealthReleaseFormRepository extends BaseRepository {

	public function __construct(AttendeeHealthReleaseForm $healthForm)
    {
        parent::__construct($healthForm);
    }
}