<?php
/**
 * @author Theodor Diaconu <diaconu.theodor@gmail.com>
 */

namespace Acme\DemoBundle\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestCase extends WebTestCase
{
    /** @var  Container */
    protected static $container;
    /** @var  TestObjectsFactory */
    protected static $factory;

    public static function setUpBeforeClass()
    {
        $client = static::createClient();
        static::$container = $client->getContainer();
        static::$factory = new TestObjectsFactory(self::$container->get('doctrine.orm.entity_manager'));
        self::clearDatabase();
    }

    public static function clearDatabase()
    {
        /** @var \Doctrine\Bundle\DoctrineBundle\Registry $doctrine */
        $doctrine = self::$container->get('doctrine');

        /** @var Connection $connection */
        $connection = $doctrine->getConnection();
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');

        $tables = $connection->getSchemaManager()->listTableNames();
        foreach ($tables as $table) {
            $connection->executeQuery(sprintf('TRUNCATE TABLE %s', $table));
        }

        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }
}