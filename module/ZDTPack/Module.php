<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZDTPack;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * this module extending ZendDevelopTools toolbar about new features
 */
class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        /*$e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);*/
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'mongo_profiler' => function( $sm ) {
                    $profiler_config = $sm->get('config')['mongo_profiler'];
                    $profiler_class  = $profiler_config['class'];

                    $options = isset( $profiler_config['options'] ) ? $profiler_config['options'] : [];

                    $profiler = new $profiler_class( $options );

                    return $profiler;
                }
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
