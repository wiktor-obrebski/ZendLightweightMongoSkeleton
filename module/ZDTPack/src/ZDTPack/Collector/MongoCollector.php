<?php
/**
 * Zend Developer Tools for Zend Framework (http://framework.zend.com/)
 *
 * @link       http://github.com/zendframework/ZendDeveloperTools for the canonical source repository
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd New BSD License
 * @package    ZendDeveloperTools
 * @subpackage Collector
 */

namespace ZDTPack\Collector;

use Zend\Mvc\MvcEvent;
use ZendDeveloperTools\Collector\AbstractCollector;

/**
 * Event Data Collector.
 *
 * @category   Zend
 * @package    ZendDeveloperTools
 * @subpackage Collector
 */
class MongoCollector extends AbstractCollector
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'mongo';
    }

    /**
     * @inheritdoc
     */
    public function getPriority()
    {
        return 100;
    }

    /**
     * @inheritdoc
     */
    public function collect(MvcEvent $mvcEvent)
    {
        $sm = $mvcEvent->getApplication()->getServiceManager();
        $this->data = $sm->get('mongo_profiler')->getStoredData();
    }

    public function getQueries()
    {
        $result = [];
        foreach( $this->data as $value ) {
            $result[ $value['query'] ] = $value['time'];
        }
        return $result;
    }

    public function getQueryCount()
    {
        return count( $this->data );
    }

    public function getTotalTime()
    {
        return array_sum( array_map( function( $el ) {
            return $el['time'];
        }, $this->data ) );
    }
}