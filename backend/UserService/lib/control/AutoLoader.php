<?php
namespace lib\control;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
class AutoLoader {

    public static function autoload($class)
    {
        $folders = array();
        $folders[] = 'app/model';
        $folders[] = 'app/controller';
        $folders[] = 'app/service';
        $folders[] = 'app/repository';
        $folders[] = 'app/request';
        $folders[] = 'lib/control';
        $folders[] = 'lib/control/actionresult';
        $folders[] = 'lib/control/validator';        
        $folders[] = 'lib/data';
        $folders[] = 'lib/service';
        $folders[] = 'app/response';
                
        if (file_exists("{$class}.class.php"))
        {
            require_once "{$class}.class.php";
            return TRUE;
        }
                
        if (file_exists("{$class}.php"))
        {
            require_once "{$class}.php";
            return TRUE;
        }
        
        foreach ($folders as $folder)
        {
            if (file_exists("{$folder}/{$class}.php"))
            {
                require_once "{$folder}/{$class}.php";
                return TRUE;
            }
            else
            {
                
                if (file_exists($folder))
                {
                    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder),
                                                            RecursiveIteratorIterator::SELF_FIRST) as $entry)
                    {
                        if (is_dir($entry))
                        {
                            
                            if (file_exists("{$entry}/{$class}.php"))
                            {
                                
                                require_once "{$entry}/{$class}.php";
                                return TRUE;
                            }
                        }
                    }
                }
            }
        }
    }
}