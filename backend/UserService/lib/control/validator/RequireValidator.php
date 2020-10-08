<?php



class RequireValidator implements Validator{

    public function validate($field, $value)
    {
        if((!$value) && $value != "0"){
            throw new Exception($field." is required!");
        }
    }

}