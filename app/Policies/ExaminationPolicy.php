<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExaminationPolicy {
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Who can view examinations?
     * @param User $user
     * @return bool
     */
    public function view(User $user) {
        return !$user->isStudent();
    }
}
