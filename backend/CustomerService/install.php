<?php

if (!isset($argv[1]) && $argv[1] == null && !$argv[1]) 
{
    throw new Exception("É necessário informar o ambiente 'enviroment' para instalar o php!");
}else{

    $enviroment = $argv[1];

    copydir('enviroments/' . $enviroment, 'app/config');

    if ($enviroment == 'prod') {
        unlink("tests");
        unlink("install.php");    
    }
}
function copydir($diretorio, $destino)
{
    if ($destino{
    strlen($destino) - 1} == '/') {
        $destino = substr($destino, 0, -1);
    }
    if (!is_dir($destino)) {
        mkdir($destino, 0755);
    }

    $folder = opendir($diretorio);

    while ($item = readdir($folder)) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (is_dir("{$diretorio}/{$item}")) {
            copydir("{$diretorio}/{$item}", "{$destino}/{$item}");
        } else {
            copy("{$diretorio}/{$item}", "{$destino}/{$item}");
        }
    }
}
