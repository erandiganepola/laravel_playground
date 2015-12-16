<?php namespace App\Models;

use App\Utils;
use InvalidArgumentException;
use DB;
use Exception;
use PDO;
use Log;

class MusicClass extends BaseModel
{
    private $id_code;
    private $id_edition;
    private $name;
    private $startDate;
    private $duration;
    private $type;
    private $dayOfWeek;
    private $time;


    const TYPE_INDIVIDUAL = "I";
    const TYPE_GROUP = "G";

    public function getID()
    {
        return "".($this->id_code)."-".($this->id_edition);
    }

    public function getIDCode()
    {
        return ($this->id_code);
    }


    public function setIDCode($value)
    {
        if(is_null($this->id_code))
            $this->id_code = $value;
        else
            throw new Exception("Code is set already. Code may only be set once");
    }


    public function getIDEdition()
    {
        return ($this->id_edition);
    }

    protected function setIDEdition($value)
    {
        if(is_null($this->id_edition))
            $this->id_edition = $value;
        else
            throw new Exception("The ID Edition is already set. Edition may be set only once");
    }
    public function  getName()
    {
        return $this->name;
    }


    public function setName($value)
    {
        $this->name = $value;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($value)
    {
        $this->startDate = $value;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($value)
    {
        $this->duration = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($value)
    {
        if(strcmp($value,MusicClass::TYPE_INDIVIDUAL) == 0)
        {
            $this->type = MusicClass::TYPE_INDIVIDUAL;
        }
        else if(strcmp($value,MusicClass::TYPE_GROUP) == 0)
        {
            $this->type = MusicClass::TYPE_GROUP;
        }
        else
            throw new Exception("Unknown Type. Class must be individual or group.");
    }

    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }
    public function setDayOfWeek($value)
    {
        if(Utils::validateDay($value))
            $this->dayOfWeek = $value;
        else
            throw new Exception("Invalid day of week");
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($value)
    {
        $this->time = $value;
    }

    /**
     * Fetch a class from the ID of the class
     *
     * @param $code
     * @param $edition
     * @return MusicClass
     */
    public static function fromCodeEdition($code, $edition)
    {
        $pdo = DB::connection()->getPdo();

        //get class details from database
        $statement = $pdo->prepare("SELECT * FROM class WHERE class_id_code = :idCode AND class_id_edition = :idEdition;");
        $statement->bindParam("idCode", $code, PDO::PARAM_STR);
        $statement->bindParam("idEdition", $edition, PDO::PARAM_INT);
        $statement->execute();

        if ($statement->rowCount() != 1)
            throw new InvalidArgumentException("Invalid class ID");

        $result = $statement->fetch();

        $mclass = new MusicClass();
        $mclass->loadFromData($result);

        return $mclass;
    }


    /**
     * Load the MusicClass object with data fetched from the database
     *
     * @param $data
     * @throws \App\Models\Exception
     */
    protected function loadFromData($data)
    {
        $this->id_code = $data["class_id_code"];
        $this->id_edition = $data["class_id_edition"];
        $this->name = $data["name"];
        $this->startDate = $data["start_date"];
        $this->duration = $data["duration"];
        $this->type = $data["type"];
        $this->dayOfWeek = $data["timeslot_day"];
        $this->time=$data['timeslot_time'];

    }






    /**
     * Insert a music class to the Database
     *
     * @param $mc
     * @return MusicClass
     * @throws Exception
     * @throws \App\Models\Exception
     */
    public static function insertClass($mc)
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("INSERT INTO class (class_id_code,name,start_date,duration,type,timeslot_day, timeslot_time) VALUES (:code,:name, :start_date, :duration, :type, :timeslot_day, :timeslot_time);");



        $result = $statement->execute(array("code" => $mc->getIDCode(),
            "name" => $mc->getName(), "start_date" => $mc->getStartDate(),"duration"=>$mc->getDuration(), "type"=>$mc->getType(), "timeslot_day" => $mc->getDayOfWeek(), "timeslot_time"=>$mc->getTime()
            ));

        if (!$result)
            throw new Exception("Unable to insert class");

        //last inserted ID
        $fetchIdStatement = $pdo->prepare("SELECT class_id_edition FROM class WHERE class_id_code = :code ORDER BY class_id_edition DESC LIMIT 1");
        $fetchIdStatement->execute(array("code" => $mc->getIDCode()));
        $result = $fetchIdStatement->fetch();

        $mc->setIDEdition($result["class_id_edition"]);
        //finally return the student object
        return self::fromCodeEdition($mc->getIDCode(),$result["class_id_edition"]);
    }

    public function __construct()
    {
        $this->id_code = null;
        $this->id_edition = null;
    }

    /**
     * Get all the classes that are available in the database.
     * Returned as an array of class objects
     *
     * @return array MusicClass[]
     */
    public static function getClasses()
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("SELECT * FROM class");
        $statement->execute();

        $classes = array();
       while($result = $statement->fetch()) {
            $mc = new MusicClass();
            $mc->loadFromData($result);
            $classes[] = $mc;

        }
        return $classes;
    }

    /**
     * Get the class as an PHP array.
     * To be used in the JSON form.
     *
     * @return array
     */
    public function toArray()
    {
        $mc = array();
        $mc['id_code'] = $this->id_code;
        $mc['id_edition'] = $this->id_edition;
        $mc['name'] = $this->name;
        $mc['startDate'] = $this->startDate;
        $mc['duration'] = $this->duration;
        $mc['type'] = $this->type;
        $mc['dayOfWeek'] = $this->dayOfWeek;
        $mc['time'] = $this->time;

        return $mc;
    }



}