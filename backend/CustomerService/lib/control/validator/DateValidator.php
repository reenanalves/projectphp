<?php


class DateValidator implements Validator{

    public function __construct(){
    }

    public function validate($field, $value)
    {
        try{
            new DateTime($value);
        }catch(Exception $e){
            throw new Exception($field." field date is invalid!");
        }
    }

}