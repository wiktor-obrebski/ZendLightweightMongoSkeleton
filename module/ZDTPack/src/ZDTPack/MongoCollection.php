<?php

namespace ZDTPack;

/**
 * override default \Mongo_Collection from colinmollenhour
 * library to have better profiling effects when iterating
 */
class MongoCollection extends \Mongo_Collection
{
  private function start_iterate_profiling()
  {
    if($this->db()->profiling) {
      $this->_bm = $this->db()->profiler_start("Mongo_Database::$this->db", $this->inspect());
    }
  }

  private function check_iterate_profiling()
  {
    if( !$this->_cursor->hasNext() && isset( $this->_bm ) ) {
      $this->db()->profiler_stop( $this->_bm );
      unset( $this->_bm );
    }
  }

  /**
   * let by default elements iterating by default, Cursor way, or by Iterator interface
   * when we are in profiling mode
   */
  public function as_array( $objects = null )
  {
    return parent::as_array( $objects ?: $this->db()->profiling );
  }
  /**
   * Implement MongoCursor#hasNext to ensure that the cursor is loaded
   *
   * @return  bool
   */
  public function hasNext()
  {
    if( !$this->is_iterating() ) $this->start_iterate_profiling();

    return $this->cursor()->hasNext();
  }

  /**
   * adding one profiler_start method, removing profiler_stop
   * Iterator: rewind
   */
  public function rewind()
  {
    try
    {
      $this->start_iterate_profiling();
      $this->cursor()->rewind();
    }
    catch(MongoCursorException $e) {
      throw new MongoCursorException("{$e->getMessage()}: {$this->inspect()}", $e->getCode());
    }
    catch(MongoException $e) {
      throw new MongoException("{$e->getMessage()}: {$this->inspect()}", $e->getCode());
    }
  }

  /**
   * removing profiler_stop when check current (when iterate)
   * Iterator: current
   *
   * @return array|Mongo_Document
   */
  public function current()
  {
    $data = $this->_cursor->current();
    $this->check_iterate_profiling();

    if( ! $this->_model)
    {
      return $data;
    }
    $model = clone $this->get_model();
    return $model->load_values($data,TRUE);
  }
}