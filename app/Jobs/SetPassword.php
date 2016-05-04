<?php namespace AllAccessRMS\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Jobs\Job;
use AllAccessRMS\Accounts\Users\UserRepository;

class SetPassword extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $userId;

    protected $newPassword;

    public function __construct($userId, $newPassword)
    {
        $this->userId = $userId;
        $this->newPassword = $newPassword;
    }

    public function handle()
    {
        $users = new UserRepository();
        $user = $users->findById($this->userId);

        $user->password = $this->newPassword;
        $user->update();
    }


}