<?php

class Utils{

   

    public static function getDatabaseConfig()
    {
        return parse_ini_file("app/config/database.ini");
    }

    public static function getIniConfig()
    {
        return parse_ini_file('app/config/config.ini', true);
    }

    public static function getHeaders()
    {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $headers[str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
            }
        }
        return $headers;
    }

    public static function convertObjectToArray($objects, $attributes = null)
    {
        
        $data = array();
        if (!empty($objects))
        {
            foreach ($objects as $key => $value)
            {
                if ((($attributes == null) or in_array($key, $attributes)) AND is_string($key))
                {
                    $data[$key] = $value;
                }
            }
        }

        return $data;
    }

}