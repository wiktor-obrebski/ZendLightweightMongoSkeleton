<?php
return array(
    'modules' => array(
        'Alcarin',
        'Core',
        //external libraries
        'AssetsCompiler',
        'ZfcTwig',
        'ZfcBase',
        'ZfcUser',
        /*'DoctrineModule',
        'DoctrineMongoODMModule',
        //adapter for zfc-user and mongo-odm
        'ZfcUserDoctrineMongoODM',*/
        //profiling modules, can be removed in production
        'ZendDeveloperTools',
        'ZDTPack',
        'ZF2NetteDebug'
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
