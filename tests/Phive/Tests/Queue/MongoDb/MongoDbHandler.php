<?php

namespace Phive\Tests\Queue\MongoDb;

use Phive\Queue\MongoDb\MongoDbQueue;
use Phive\Tests\Queue\AbstractHandler;

class MongoDbHandler extends AbstractHandler
{
    /**
     * @var \Mongo
     */
    protected $mongo;

    /**
     * @var \MongoCollection
     */
    protected $collection;

    public function __construct(array $options = array())
    {
        if (!extension_loaded('mongo')) {
            throw new \RuntimeException('The "mongo" extension is not loaded.');
        }

        parent::__construct($options);
    }

    public function createQueue()
    {
        return new MongoDbQueue($this->getCollection());
    }

    public function reset()
    {
        $this->mongo->dropDB($this->getOption('db_name'));
    }

    public function clear()
    {
        $this->getCollection()->remove(array(), array('safe' => true));
    }

    protected function getCollection()
    {
        if (!$this->collection) {
            $this->collection = $this->mongo->selectCollection(
                $this->getOption('db_name'),
                $this->getOption('coll_name')
            );
        }

        return $this->collection;
    }

    protected function configure()
    {
        $this->mongo = new \Mongo($this->getOption('server'));
    }
}