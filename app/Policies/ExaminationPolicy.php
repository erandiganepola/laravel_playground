<?php

namespace App\Policies;

use App\Examination;
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
     * @param null $examination
     * @return bool
     */
    public function view(User $user, $examination = null) {
        if (($examination instanceof Examination) && $user->isStudent()) {
            return $user->id == $$examination->student->id;
        }

        return true;
    }

    /**
     * Who can apply a given exam?
     * @param User $user
     * @param Examination $examination
     * @return bool
     */
    public function apply(User $user, Examination $examination) {
        return $user->isStudent();
    }

    /**
     * Only chief executive can add examinations.
     * @param User $user
     * @return bool
     */
    public function add(User $user) {
        return $user->isChiefExecutive();
    }
}
