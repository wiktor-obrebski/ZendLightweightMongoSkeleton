<?php
return array(
    'modules' => array(
        'App',
        'Core',
        //external libraries
        'AssetsCompiler',
        'ZfcTwig',
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
