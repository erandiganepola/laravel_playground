<?php namespace App\Models;

/**
 * Model for students
 */

use App\Models\StudentParentPair\StudentParentPair;
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
     * Get the parents of a given student
     *
     * @return array
     */
    public function getParents()
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("SELECT * FROM student_parent JOIN parent ON (parent.nic = student_parent.parent_nic) WHERE student_parent.student_ID = :studentID;");
        $statement->execute(array("studentID" => $this->getID()));

        $outputs = array();
        while ($row = $statement->fetch()) {
            $parent = new Guardian();
            $parent->loadFromData($row);
            $pair = new StudentParentPair($this, $parent, $row["is_guardian"]);
            array_push($outputs, $pair);
        }

        return $outputs;
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
     * Adds a parent to the student
     *
     * @param $parent
     * @throws Exception
     */
    public function addParent($parent)
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("INSERT INTO student_parent (student_ID, parent_NIC,is_guardian) VALUES (:studentID,:parentNIC, FALSE);");
        $result = $statement->execute(array("studentID" => $this->getID(), "parentNIC" => $parent->getNIC()));
        if (!$result)
            throw new Exception("Unable to Add Parent");

    }


    /**
     * Removes a parent from a given student
     *
     * @param $parent
     * @throws Exception
     */
    public function removeParent($parent)
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("REMOVE FROM student_parent WHERE student_ID = :studentID AND parent_nic = :parentNIC AND is_guardian = FALSE);");
        $result = $statement->execute(array("studentID" => $this->getID(), "parentNIC" => $parent->getNIC()));
        if (!$result)
            throw new Exception("Unable to Remove Parent");
    }


    /**
     * Set the guardian of a student
     *
     * @param $guardian
     * @throws Exception
     */
    public function setGuardian($guardian)
    {
        $this->clearGuardians();
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("INSERT INTO student_parent (student_ID, parent_NIC,is_guardian) VALUES (:studentID,:parentNIC, TRUE);");
        $result = $statement->execute(array("studentID" => $this->getID(), "parentNIC" => $guardian->getNIC()));
        if (!$result)
            throw new Exception("Unable to Set Guardian");
    }


    /**
     * Clears the guardians of a student
     *
     * @throws Exception
     */
    public function clearGuardians()
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("DELETE FROM student_parent WHERE student_ID = :studentID;");
        $result = $statement->execute(array("studentID" => $this->getID()));
        if (!$result)
            throw new Exception("Unable to Clear Guardians");
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
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("SELECT * FROM student");
        $statement->execute();

        $results = $statement->fetchAll();

        $students = array();
        foreach ($results as $result) {
            $students[] = self::fromID($result["ID"]);
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



    /**
     * Get the student as an PHP array.
     * To be used in the JSON form.
     *
     * @return array
     */
    public function toArray()
    {
        $student=array();
        $student['id']=$this->id;
        $student['date_of_birth']=$this->date_of_birth;
        $student['address']=$this->address;
        $student['name']=$this->name;
        $student['gender']=$this->gender;
        $student['phones']=$this->phones;

        return $student;
    }

}