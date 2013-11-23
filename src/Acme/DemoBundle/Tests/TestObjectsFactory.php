<?php
/**
 * @author Theodor Diaconu <diaconu.theodor@gmail.com>
 */

namespace Acme\DemoBundle\Tests;


class TestObjectsFactory
{
    public function __construct($em)
    {
        $this->em = $em;
    }

    public function createRandomUser()
    {

    }

    public function createRandomPost()
    {

    }
} 