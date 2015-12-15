<?php namespace App\Models;

abstract class BaseModel
{

    /**
     * Abstract method toArray
     * To get the data/details of a model in a JSON compatible manner.
     *
     * @return mixed
     */
    public abstract function toArray();

}