<?php

require __DIR__ . '/vendor/autoload.php';

$ini = parse_ini_file('app/config/database.ini', true);

return [
    'paths' => [
        'migrations' => [
            __DIR__ .'/migrations'
        ],
        'seeds' => [
            __DIR__ .'/seeds'
        ]
    ],    
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => $ini['database']['name'],
        $ini['database']['name'] => [
            'adapter' => 'mysql',
            'host' => $ini['database']['host'],
            'name' => $ini['database']['name'],
            'user' => $ini['database']['user'],
            'pass' => $ini['database']['pass'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'table_prefix' => '',
            'table_suffix' => ''
        ]
    ]
];