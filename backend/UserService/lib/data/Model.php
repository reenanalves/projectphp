<?php

abstract class Model {
    
    private $properties = [];
    private $validates = [];
    private $values = [];
    protected $primarykey = "id";   

    public function __construct()
    {
        foreach($this->properties as $value)
        {
            $this->values[$value] = "";
        }
    }

    public function setValues(array $data)
    {
        foreach ($data as $key => $value)
        {                        
            $this->setValue($key, $value);                            
        }
    }

    public function getValues(){
        return $this->values;
    }

    public function getProperties($includeprimarykey = true){
        
        $properties = clone $this->properties;
        
        if(!$includeprimarykey){
            unset($properties[$this->primarykey]);
        }

        return $properties;
    }

    public function getValuesParamsToQuery($includeprimarykey = true){

        $properties = clone $this->properties;

        if(!$includeprimarykey){
            unset($properties[$this->primarykey]);
        }

        $data = [];

        foreach($properties as $key => $value){
            $data[$key] = [":".$value => $this->values[$key]];
        }

        return $data;
    }

    public function getParamsToUpdateQuery($includeprimarykey = true){

        $data = [];

        foreach($this->properties as $key => $value){

            if($key == $this->primarykey AND !$includeprimarykey){
                continue;
            }
            
            $data[$key] = [$value => ":".$value];
        }

        return $data;
    }

    private function setValue($property, $value){
        if (in_array($property, $this->properties))
        {
            $this->validateValue($property, $value);
            $this->values[$property] = $value;
        }
    }

    public function __set($property, $value){
        $this->setValue($property, $value);
    }

    public function __get($property){
        return $this->values[$property];
    }

    public function validateValue($property, $value){        
        foreach($this->validates[$property] as $validator)
        {
            $validator->validate($property, $value);
        }
    }

    public function validate(){
        foreach($this->values as $key => $value){
            $this->validateValue($key, $value);
        }
    }

    public function setProperty(string $property, array $validates = [])
    {
        if(in_array($property, $this->properties)){
            throw new Exception("Property exists!");
        }

        foreach($validates as $validator){
            if(!($validator instanceof Validator)){
                throw new Exception("Validates invalid!");
            }
        }

        $this->properties[] = $property;
        $this->validates[$property] = $validates;     

    }
    

}