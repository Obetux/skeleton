<?php
namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager as Doctrine;
use Psr\SimpleCache\CacheInterface;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Stopwatch\Stopwatch;

class TestService
{
    /**
     * @var Doctrine
     */
    private $doctrine;
    /**
     * @var CacheInterface $cache
     */
    private $cache;

    /**
     * @var Logger $logger
     */
    private $logger;

    /**
     * @var Stopwatch $stopwatch
     */
    private $stopwatch;

    /**
     * User constructor.
     *
     * @param Doctrine $doctrine
     * @param CacheInterface $cache
     * @param Logger $logger
     * @param Stopwatch $stopwatch
     */
    public function __construct(Doctrine $doctrine, CacheInterface $cache, Logger $logger, Stopwatch $stopwatch)
    {
        $this->doctrine = $doctrine;
        $this->cache = $cache;
        $this->logger = $logger;
        $this->stopwatch = $stopwatch;
    }

    /**
     * @param $test
     * @return bool
     */
    public function something($test)
    {
        return $test;
    }
}