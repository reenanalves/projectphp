<?php


class MaxLengthValidator implements Validator{

    private $length;

    public function __construct($length){
        $this->length = $length;
    }

    public function validate($field, $value)
    {
        if(strlen($value) > $this->length){
            throw new Exception($field." exceeded the allowed limit!");
        }
    }

}