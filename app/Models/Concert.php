<?php

namespace App\Models;


use DB;

class Concert{
    private $year;
    private $date;
    private $title;
    private $description;


    public static function fromYear($year){
        $pdo=DB::getPdo();
        $statement=$pdo->prepare("SELECT * FROM concert WHERE year = :year");
        $statement->execute(array('year'=>$year));

        if($statement->rowCount()!=1){
            throw new Exeption("Invalid concert year!");
        }

        $result=$statement->fetch();

        $concert=new Concert();
        $concert->loadFromData($result);

        return $concert;
    }




    public static function insertConcert($concert){
        $pdo=DB::getPdo();
        $statement=$pdo->prepare("INSERT INTO concert (year,date,title,description) VALUES (:year,:date,:title,:description)");
        $success=$statement->execute(array('year'=>$concert->getYear(),'date'=>$concert->getYear(),
            'title'=>$concert->getTitle(),'description'=>$concert->getDescription()));

        if(!$success){
            throw new Exception("Unable to insert the concert");
        }

    }



    private function loadFromData($result){
        $this->year=$result['year'];
        $this->date=$result['date'];
        $this->title=$result['title'];
        $this->description=$result['description'];
    }


    public function getYear(){
        return $this->year;
    }

    public function getDate(){
        return $this->date;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setYear($year){
        $this->year=$year;
    }

    public function setDate($date){
        $this->date=$date;
    }

    public function setTitle($title){
        $this->year=$title;
    }

    public function setDescription($description){
        $this->description=$description;
    }

    public function getDescription(){
        return $this->description;
    }

}