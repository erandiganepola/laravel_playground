<?php namespace App\Models;

/**
 * Model for teachers
 */

use InvalidArgumentException;
use DB;
use Exception;
use PDO;
use Log;

class Instrument extends BaseModel
{
    private $name;

    /**
     * Insert an instrument to the database.
     *
     * @param $name
     * @throws Exception
     * @throws \App\Models\Exception
     */
    public static function insertInstrument($name)
    {
        $pdo = DB::connection()->getPdo();
        
        $statement = $pdo->prepare("INSERT INTO instrument (name) VALUES (:name);");
        $result_insert_instrument = $statement->execute(array("name" => $name));
       
        
         if (!$result_insert_instrument)
            throw new Exception("Unable to insert instrument");

    }

    public function __construct()
    {

    }

    public static function deleteInstrument($name)
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("REMOVE FROM instrument WHERE name = :nameIn ;");
        $result = $statement->execute(array("nameIn" => $name));
        
         if (!$result)
            throw new Exception("Unable to remove instrument");
    }

   

    /**
     * Get all the instruments that are available in the database.
     * Returned as an array of Teacher objects
     *
     * @return array instrument[]
     */
    public static function getInstruments()
    {
        $pdo = DB::connection()->getPdo();
        $statement = $pdo->prepare("SELECT * FROM instrument");
        $statement->execute();

        $results = $statement->fetchAll();

        $instruments= array();
        foreach ($results as $result) {
            $instruments[] = $result["name"];
        }
        return $instruments;
    }


    /**
     * Abstract method toArray
     * To get the data/details of a model in a JSON compatible manner.
     *
     * @return mixed
     */
    public function toArray()
    {
        // TODO: Implement toArray() method.
    }



}