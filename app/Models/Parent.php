<?php namespace App\Models;

//Represents parent table entity in DB

use InvalidArgumentException;
use DB;
use Exception;
use PDO;
class Guardian extends BaseModel
{

    public static function fromNIC($nic)
    {
        $pdo = DB::connection()->getPdo();
        $statement= $pdo->prepare("SELECT * FROM parent WHERE nic = :nic;");
        $statement->bindParam("nic",$nic,PDO::PARAM_STR);
        $statement->execute();

        if($statement->rowCount() != 1)
            throw new InvalidArgumentException("Invalid NIC");

        $result = $statement->fetch();

        $guardian = new Guardian();
        $guardian>loadFromData($result);
        return $guardian;

    }


    public static function insertParent($parent)
    {
        $pdo = DB::connection()->getPdo();
        $statement= $pdo->prepare("INSERT INTO parent (name,nic,gender) VALUES (:name,:nic, :gender);");


        $result = $statement->execute(array( "name" => $parent->getName(), "nic" => $parent->getNIC(),"gender" => Person::genderToString($parent->getGender())));
        if(!$result)
            throw new Exception("Unable to insert parent");


    }


    public function __construct()
    {

    }

    protected function loadFromData($data)
    {
        $this->nic = $data["nic"];
        $this->name=$data["name"];
        $this->gender=Person::parseGender($data["gender"]);

    }




    private $name;
    private $gender;
    private $nic;

    public function getName()
    {
        return $this->name;
    }
    public function getGender()
    {
        return $this->gender;
    }
    public  function getNIC()
    {
        return $this->nic;
    }

    public function setName($value)
    {
        $this->name = $value;
    }
    public  function setGender($value)
    {
        $this->gender = $value;
    }
    public function setNIC($value)
    {
        $this->nic = $value;
    }


}