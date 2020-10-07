<?php



class RequireValidator implements Validator{

    public function validate($field, $value)
    {
        if(!$value){
            throw new Exception($field." is required!");
        }
    }

}