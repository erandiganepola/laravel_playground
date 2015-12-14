<?php namespace App\Models;
abstract class Person
{
    const GENDER_MALE = "M";
    const GENDER_FEMALE = "F";

    public static function parseGender($gender)
    {
        if(strcmp("M",$gender) == 0)
        {
            return Person::GENDER_MALE;
        }
        else if(strcmp("F",$gender))
        {
            return Person::GENDER_FEMALE;
        }
        throw new Exception("Invalid Gender");
    }

    public static function genderToString($gender)
    {
        if($gender == Person::GENDER_MALE)
        {
            return "M";
        }
        else if($gender == Person::GENDER_FEMALE)
        {
            return "F";
        }
        throw new Exception("Invalid Gender");
    }

}