<?php namespace App\Models\StudentParentPair;
use App\Models\BaseModel;
use InvalidArgumentException;
use DB;
use Exception;
use PDO;

class StudentParentPair extends BaseModel
{
    private $student;
    private $parent;
    private $isGuardian;

    public function  __construct($student, $parent, $isGuardian)
    {
        $this->parent = $parent;
        $this->student=$student;
        $this->isGuardian = $isGuardian;

    }

    public function getStudent()
    {
        return $this->student;
    }

    public function getParent()
    {
        return $this->parent;
    }
    public function isGuardian()
    {
        return $this->isGuardian;
    }


    /**
     * Array representation of a student parent pair
     *
     * @return array
     */
    public function toArray(){
        $pair=array();
        $pair['student']=$this->student->toArray();
        $pair['parent']=$this->parent->toArray();
        $pair['isGuardian']=$this->isGuardian();

        return $pair;

    }
}