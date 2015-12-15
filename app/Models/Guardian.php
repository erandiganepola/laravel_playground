<?php namespace App\Models;

//Represents parent table entity in DB

use InvalidArgumentException;
use DB;
use Exception;
use PDO;

class Guardian extends BaseModel
{

    /**
     * Get the parent from the NIC
     *
     * @param $nic
     * @return Guardian
     */
    public static function fromNIC($nic)
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("SELECT * FROM parent WHERE nic = :nic;");
        $statement->bindParam("nic", $nic, PDO::PARAM_STR);
        $statement->execute();

        if ($statement->rowCount() != 1)
            throw new InvalidArgumentException("Invalid NIC");

        $result = $statement->fetch();

        $guardian = new Guardian();
        $guardian->loadFromData($result);
        return $guardian;

    }


    /**
     * Find a parent from NIC using the static fromNIC method.
     * Return null, if not available
     *
     * @param $nic
     * @return Guardian|null
     */
    public static function find($nic)
    {
        $guardian = null;
        try {
            $guardian = self::fromNIC($nic);
        } catch (Exception $e) {
            return null;
        }

        return $guardian;
    }


    public static function insertParent($parent)
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("INSERT INTO parent (name,nic,gender) VALUES (:name,:nic, :gender);");

        $result = $statement->execute(array("name" => $parent->getName(), "nic" => $parent->getNIC(),
            "gender" => Person::genderToString($parent->getGender())));

        if (!$result)
            throw new Exception("Unable to insert parent");

        //add telephone numbers to the student
        $addPhonesStatement = $pdo->prepare("INSERT INTO parent_telephone (nic,telephone_number) VALUES (:nic,:phone)");
        foreach ($parent->getPhones() as $phone) {
            if (!empty($phone)) {
                $success = $addPhonesStatement->execute(array('nic' => $parent->getNIC(), 'phone' => $phone));

                if (!$success)
                    throw new Exception("Unable to add Phone Number");
            }
        }

    }


    public function getChildren()
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("SELECT * FROM student_parent JOIN student ON (student.ID = student_parent.student_ID) WHERE student_parent.parent_nic = :nic;");
        $statement->execute(array("nic" => $this->getNIC()));

        $outputs = array();
        while ($row = $statement->fetch()) {
            $student = new Student();
            $student->loadFromData($row);
            $pair = new StudentParentPair($student, this, $row["is_guardian"]);
            array_push($outputs, $pair);
        }

        return $outputs;

    }

    public function __construct()
    {

    }

    public function loadFromData($data)
    {
        $this->nic = $data["nic"];
        $this->name = $data["name"];
        $this->gender = Person::parseGender($data["gender"]);

    }


    private $name;
    private $gender;
    private $nic;
    private $phones;

    public function getName()
    {
        return $this->name;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getNIC()
    {
        return $this->nic;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function setGender($value)
    {
        $this->gender = $value;
    }

    public function setNIC($value)
    {
        $this->nic = $value;
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
     * Get the array represention of the attributes of a parent object.
     *
     * @return array
     */
    public function toArray()
    {
        return array();
    }
}