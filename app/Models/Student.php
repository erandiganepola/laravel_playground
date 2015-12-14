<?php namespace App\Models;

//Model for Student

use InvalidArgumentException;
use DB;
use Exception;
use PDO;
use Log;

class Student extends BaseModel
{
    private $id;
    private $date_of_birth;
    private $address;
    private $email;
    private $name;
    private $gender;
    private $phones;


    /**
     * Fetch a student from the ID of the student
     *
     * @param $studentId
     * @return Student
     */
    public static function fromID($studentId)
    {
        $pdo = DB::connection()->getPdo();

        //get student details from student table
        $statement = $pdo->prepare("SELECT * FROM student WHERE ID = :studentID;");
        $statement->bindParam("studentID", $studentId, PDO::PARAM_STR);
        $statement->execute();

        if ($statement->rowCount() != 1)
            throw new InvalidArgumentException("Invalid Student ID");

        $result = $statement->fetch();

        $student = new Student();
        $student->loadFromData($result);
        return $student;
    }


    /**
     * Insert an student to the database.
     *
     * @param $student
     * @throws Exception
     * @throws \App\Models\Exception
     */
    public static function insertStudent($student)
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("INSERT INTO student (name,date_of_birth,address,email,gender) VALUES (:name,:date_of_birth, :address, :email, :gender);");


        $result = $statement->execute(array("name" => $student->getName(), "date_of_birth" => $student->getDOB(), "address" => $student->getAddress(), "email" => $student->getEmail(), "gender" => Person::genderToString($student->getGender())));
        if (!$result)
            throw new Exception("Unable to insert student");


    }

    public function __construct()
    {

    }

    /**
     * Load the student object with data fetched from the database
     *
     * @param $data
     * @throws \App\Models\Exception
     */
    protected function loadFromData($data)
    {
        $this->id = $data["ID"];
        $this->date_of_birth = $data["date_of_birth"];
        $this->address = $data["address"];
        $this->email = $data["email"];
        $this->name = $data["name"];
        $this->gender = Person::parseGender($data["gender"]);


        //get the telephone numbers associated to the student
        $pdo = DB::connection()->getPdo();
        $fetchPhoneStatement = $pdo->prepare("SELECT telephone_number FROM student_telephone WHERE ID = :studentID");
        $fetchPhoneStatement->bindParam("studentID", $this->id, PDO::PARAM_STR);
        $fetchPhoneStatement->execute();
        $phoneResults = $fetchPhoneStatement->fetch();

        $this->phones = array();

        foreach ($phoneResults as $phoneResult) {
            $this->phones[] = $phoneResult;
        }

    }


    /**
     * Get all the students that are available in the database.
     * Returned as an array of Student objects
     *
     * @return array Student[]
     */
    public static function getStudents()
    {
        $pdo=DB::connection()->getPdo();
        $statement=$pdo->prepare("SELECT * FROM student");
        $statement->execute();

        $results=$statement->fetchAll();

        $students=array();
        foreach($results as $result){
            $students[]=self::fromID($result["ID"]);
        }
        return $students;
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

    public function  getEmail()
    {
        return $this->email;
    }

    public function  getName()
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
        $this->address = $value;
    }

    public function setEmail($value)
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

    public function getPhones()
    {
        return $this->phones;
    }

    public function setPhones($phones)
    {
        $this->phones = $phones;
    }

}