<?php
namespace App\Rest;

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/14/2016
 * Time: 10:33 AM
 */
class Exception
{
    public $type;
    public $message;

    public function __construct($message)
    {
        $this->type = "Exception";
        $this->message=$message;
    }

}