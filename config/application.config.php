<?php
return array(
    'modules' => array(
        'App',
        'Core',
        //external libraries
        'AssetsCompiler',
        'ZfcTwig',
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
