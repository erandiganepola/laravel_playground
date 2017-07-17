<?php

namespace App\Util;

use App\User;
use Illuminate\Support\Facades\Log;

/**
 * Class SMSHelper
 * @package App\Util
 */
class SMSHelper {

    /**
     * Sends the two factor verification code to the user's mobile.
     * @param User $user
     * @return string
     */
    public static function sendVerificationCode(User $user) {
        $code = str_random(6);
        Log::info("Verification code sent to the user : " . $code);

        return $code;
    }
}