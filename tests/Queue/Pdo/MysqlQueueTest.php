<?php

namespace Phive\Queue\Tests\Queue\Pdo;

use Phive\Queue\Tests\Handler\PdoHandler;
use Phive\Queue\Tests\Queue\AbstractQueueTest;
use Phive\Queue\Tests\Queue\ConcurrencyTrait;
use Phive\Queue\Tests\Queue\PerformanceTrait;

/**
 * @requires extension pdo_mysql
 */
class MysqlQueueTest extends AbstractQueueTest
{
    use PerformanceTrait;
    use ConcurrencyTrait;

    public static function createHandler(array $config)
    {
        return new PdoHandler([
            'dsn'        => $config['PHIVE_PDO_MYSQL_DSN'],
            'username'   => $config['PHIVE_PDO_MYSQL_USERNAME'],
            'password'   => $config['PHIVE_PDO_MYSQL_PASSWORD'],
            'table_name' => $config['PHIVE_PDO_MYSQL_TABLE_NAME'],
        ]);
    }
}