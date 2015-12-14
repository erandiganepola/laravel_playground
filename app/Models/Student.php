<?php namespace App\Models;
//Model for Student

use InvalidArgumentException;
use DB;
use Exception;
use PDO;
class Student extends BaseModel
{
    private $id;
    private $date_of_birth;
    private $address;
    private $email;
    private $name;
    private $gender;

    public static function fromID($studentId)
    {
        $pdo = DB::connection()->getPdo();
        $statement= $pdo->prepare("SELECT * FROM student WHERE ID = :studentID;");
        $statement->bindParam("studentID",$studentId,PDO::PARAM_STR);
        $statement->execute();

        if($statement->rowCount() != 1)
            throw new InvalidArgumentException("Invalid Student ID");

        $result = $statement->fetch();

        $student = new Student();
        $student->loadFromData($result);
        return $student;

    }

    public static function insertStudent($student)
    {
        $pdo = DB::connection()->getPdo();
        $statement= $pdo->prepare("INSERT INTO student (name,date_of_birth,address,email,gender) VALUES (:name,:date_of_birth, :address, :email, :gender);");


        $result = $statement->execute(array( "name" => $student->getName(), "date_of_birth" => $student->getDOB(), "address"=>$student->getAddress(), "email"=>$student->getEmail(),"gender" => Person::genderToString($student->getGender())));
        if(!$result)
            throw new Exception("Unable to insert student");


    }

    public function __construct()
    {

    }

    protected function loadFromData($data)
    {
        $this->id = $data["ID"];
        $this->date_of_birth = $data["date_of_birth"];
        $this->address=$data["address"];
        $this->email=$data["email"];
        $this->name=$data["name"];
        $this->gender=Person::parseGender($data["gender"]);

    }

    public function getID()
    {
        return $this->id;
    }

    public function getDOB()
    {
        return $this->date_of_birth;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public  function  getEmail()
    {
        return $this->email;
    }
    public  function  getName()
    {
        return $this->name;
    }
    public function  getGender()
    {
        return $this->gender;
    }

    public function setDOB($value)
    {
        $this->date_of_birth = $value;
    }

    public function setAddress($value)
    {
        $this->address=$value;
    }

    public  function setEmail($value)
    {
        $this->email = $value;
    }
    public function setName($value)
    {
        $this->name = $value;
    }
    public function setGender($value)
    {
        $this->gender = $value;
    }


}