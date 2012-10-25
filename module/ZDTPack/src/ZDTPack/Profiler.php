<?php

namespace ZDTPack;

/**
 * profiler for mongo db odm wrapper
 */
class Profiler
{
    protected $current = [];
    protected $data    = [];

    private function getKey( $group, $query )
    {
        do {
            $hash = md5(mt_rand());
        }
        while( isset( $this->current[$hash] ) );
        return $hash;
    }

    public function start($group, $query)
    {
        $key = $this->getKey( $group, $query );

        $this->current[ $key ] = [
            'begin' => microtime(true),
            'group' => $group,
            'query' => $query,
        ];
        return $key;
    }

    public function stop( $key )
    {
        $time = microtime(true);

        if( !isset($this->current[$key]) ) {
            throw new \Exception( sprintf(
                '`%s`: Calling stop for group "%s" before start.',
                __METHOD__,
                $key ));
        }

        $data = $this->current[$key];
        unset( $this->current[$key] );

        $time = 1000 * ($time - $data['begin']);
        unset($data['begin']);

        $data['time'] = $time;

        $this->data []= $data;
    }

    public function getStoredData()
    {
        return $this->data;
    }
}