<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'zdt-pack' => __DIR__ . '/../view',
        ),
    ),

    'mongo' => array(
        'collection'    => 'ZDTPack\MongoCollection'
    ),

    'mongo_profiler' => array(
        'class'   => 'ZDTPack\Profiler',
        'options' => array(
        ),
    ),

    'service_manager' => array(
        'invokables' => array(
            'ZDTPack\MongoCollector'     => 'ZDTPack\Collector\MongoCollector',
            'ZDTPack\MongoCollection'   => 'ZDTPack\MongoCollection',
        ),
    ),
);
