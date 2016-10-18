<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResultPolicy {
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
     * Who can view a result
     * @param User $user
     * @return bool
     */
    public function view(User $user) {
        return $user->isStudent();
    }

    /**
     * Who can view a students'results in bulk
     * @param User $user
     * @return bool
     */
    public function bulkView(User $user) {
        return $user->isStudent();
    }
}
