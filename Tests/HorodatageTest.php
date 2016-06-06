<?php

namespace Consoneo\Bundle\UniversignBundle\Tests;

use Consoneo\Bundle\UniversignBundle\Horodatage;
use Mockery as m;
use Symfony\Component\Yaml\Parser;

/**
 * Created by Gabriel Poret <gporet@consoneo.com>
 * Copyright: Consoneo
 * 
 * Class HorodatageTest
 * @package Consoneo\Bundle\UniversignBundle\Tests
 */
class HorodatageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Horodatage
     */
    private $horodatage;

    /**
     * @throws \Exception
     * @throws \Symfony\Component\Yaml\Exception\ParseException
     */
    protected  function setUp()
    {
        if (! file_exists(__DIR__ . '/parameter.yml'))
        {
            echo 'for run the test, please copy the file /Tests/parameter.yml.dist to /Tests/parameter.yml with your own configuration';
            exit;
        }

        $yaml = new Parser();
        list($login, $password) =  $yaml->parse(file_get_contents(__DIR__ . '/parameter.yml'));
        
        $this->horodatage =  new Horodatage($login, $password);

        $this->horodatage->setDoctrine($this->getMockDoctrine());
    }

    public function testPostPdfSuccess()
    {
        $file = __DIR__ . '/test.pdf';
        $fileTimestamped = __DIR__ . '/testTimestamped.pdf';

        file_put_contents($fileTimestamped, $this->horodatage->postPdf(file_get_contents($file)));
    }
    /**
     * @return m\MockInterface
     */
    private function getMockDoctrine()
    {
        $doctrine = m::mock('Doctrine\Bundle\DoctrineBundle\Registry');

        $doctrine
            ->shouldReceive('getManager')->times(10)
            ->andReturn($this->getMockManager());

        return $doctrine;
    }

    private function getMockManager()
    {
        $manager = m::mock('Doctrine\ORM\EntityManager');

        $manager
            ->shouldReceive('getRepository')->andReturn($this->getMockRepository())
            ->shouldReceive('persist')->times(10)->andReturn(true)
            ->shouldReceive('flush')->times(10)->andReturn(true)
        ;

        return $manager;
    }

    private function getMockRepository()
    {
        $repo =  m::mock('Doctrine\ORM\EntityRepository');

        $repo
            ->shouldReceive('findOneBy')->andReturnNull();
        return $repo;
    }
}