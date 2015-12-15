<?php namespace App\Models;

/**
 * Model for teachers
 */

use InvalidArgumentException;
use DB;
use Exception;
use PDO;
use Log;

class Teacher extends BaseModel
{
    private $teacher_id;
    private $name;
    private $gender;
    private $nic;
    private $address;
    private $date_of_birth;
    private $active;
    private $phones;

    /**
     * Fetch a teacher from the ID of the Teacher
     *
     * @param $teacherId
     * @return Teacher
     */
    public static function fromID($teacherId)
    {
        $pdo = DB::connection()->getPdo();

        //get teacher details from teacher table
        $statement = $pdo->prepare("SELECT * FROM teacher WHERE teacher_id = :teacherId;");
        $statement->bindParam("teacherId", $teacherId, PDO::PARAM_STR);
        $statement->execute();

        if ($statement->rowCount() != 1)
            throw new InvalidArgumentException("Invalid Teacher ID");

        $result = $statement->fetch();

        $teacher = new Teacher();
        $teacher->loadFromData($result);
        return $teacher;
    }

    /**
     * Insert an teacher to the database.
     *
     * @param $teacher
     * @throws Exception
     * @throws \App\Models\Exception
     */
    public static function insertTeacher($teacher)
    {
        $pdo = DB::connection()->getPdo();
        
        $statement = $pdo->prepare("INSERT INTO teacher (name,gender,nic,address,date_of_birth,active) VALUES (:name,:gender,:nic, :address, :date_of_birth, :active);");


        $result_insert_teacher = $statement->execute(array("name" => $teacher->getName(), "gender" => Person::genderToString($teacher->getGender()), "nic" => $teacher->getNic(), "address" => $teacher->getAddress(), "date_of_birth" => $teacher->getDOB(),"active" => $teacher->getActive()));
        
        $phones=$teacher->getPhones();
        foreach($phones as $phone){
       
            $statement = $pdo->prepare("INSERT INTO teacher_telephone (teacher_id,telephone_number) VALUES (:teacher_id,:telephone_number);");
            $result_insert_teacher_telephone = $statement->execute(array("teacher_id" => $teacher->getId(), "telephone_number" =>$phone ));
            if (!$result_insert_teacher_telephone)
                throw new Exception("Unable to insert to teacher_telephone");
            
        }
        
         if (!$result_insert_teacher)
            throw new Exception("Unable to insert teacher");

    }

    public function __construct()
    {

    }


    /**
     * Load the teacher object with data fetched from the database
     *
     * @param $data
     * @throws \App\Models\Exception
     */
    protected function loadFromData($data)
    {
        $this->teacher_id = $data["teacher_id"];
        $this->name = $data["name"];
        $this->gender = Person::parseGender($data["gender"]);
        $this->nic = $data["nic"];
        $this->address = $data["address"];
        $this->date_of_birth = $data["date_of_birth"];
        $this->active = $data["active"];

        //get the telephone numbers associated to the teacher
        $pdo = DB::connection()->getPdo();
        $fetchPhoneStatement = $pdo->prepare("SELECT telephone_number FROM teacher_telephone WHERE ID = :teacherID");
        $fetchPhoneStatement->bindParam("teacherID", $this->id, PDO::PARAM_STR);
        $fetchPhoneStatement->execute();
        $phoneResults = $fetchPhoneStatement->fetch();

        $this->phones = array();

        foreach ($phoneResults as $phoneResult) {
            $this->phones[] = $phoneResult;
        }

    }


    /**
     * Get all the teachers that are available in the database.
     * Returned as an array of Teacher objects
     *
     * @return array Teacher[]
     */
    public static function getTeachers()
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("SELECT * FROM teacher");
        $statement->execute();

        $results = $statement->fetchAll();

        $teachers = array();
        foreach ($results as $result) {
            $teachers[] = self::fromID($result["ID"]);
        }
        return $teachers;
    }

    
     /**
     * Get all instruments of a teacher
     *
     * @return array Instrument[]
     */
    public function getInstrument()
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("SELECT instrument_name FROM teacher_instrument WHERE teacher_id=:teacherID");
        $statement->bindParam("teacherID", $this->teacher_id, PDO::PARAM_STR);  
        $statement->execute();

        $results = $statement->fetchAll();

        $instruments = array();
        foreach ($results as $result) {
            $instruments[] = $result["instrument_name"];
        }
        return $instruments;
    }
    
      /**
     * Add an instruments to a teacher
     
     * @return none
     */
    public function addInstrument($instrument_name)
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("INSERT INTO teacher_instrument (teacher_id,instrument_name) VALUES (:teacher_id,:instrument_name);");
        $result_insert_teacher_instrument = $statement->execute(array("teacher_id" => $this->getId(), "instrument_name" =>$instrument_name ));
        if (!$result_insert_teacher_instrument)
            throw new Exception("Unable to insert to teacher_instrument");
        
    }
    
    
    
     /**
     * getters and setters
     * 
     *
     * @return array Teacher[]
     */
    
    public function getID()
    {
        return $this->id;
    }
    
    public function getPhone()
    {
        return this->phones;
    }

    public function getDOB()
    {
        return $this->date_of_birth;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function  getActive()
    {
        return $this->active;
    }

    public function  getName()
    {
        return $this->name;
    }

    public function  getGender()
    {
        return $this->gender;
    }

    public function  getNic()
    {
        return $this->nic;
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
     * Get the teacher as an PHP array.
     * To be used in the JSON form.
     *
     * @return array
     */
    public function toArray()
    {
        $teacher=array();
        $teacher['teacher_id']=$this->teacher_id;
        $teacher['name']=$this->name;
        $teacher['gender']=$this->gender;
        $teacher['nic']=$this->nic;
        $teacher['address']=$this->address;
        $teacher['date_of_birth']=$this->date_of_birth;
        $teacher['active']=$this->active;

        return $teacher;
    }

}