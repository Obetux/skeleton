<?php

namespace App\Tests\Service;

use App\Service\TestService;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Cache\Simple\AbstractCache;
use Symfony\Component\Stopwatch\Stopwatch;

class TestServiceTest extends TestCase
{
    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function cacheMock()
    {
        $cache = $this->createMock(AbstractCache::class);

        $cache->method('has')->willReturn(false);
        $cache->method('get')->willReturn(null);
        $cache->method('set')->willReturn(null);
        $cache->method('delete')->willReturn(null);

        return $cache;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function loggerMock()
    {
        $logger = $this->createMock(Logger::class);

        $logger->method('debug')->willReturn(true);
        $logger->method('info')->willReturn(true);
        $logger->method('warning')->willReturn(true);
        $logger->method('error')->willReturn(true);

        return $logger;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function stopwatchMock()
    {
        $stopwatch = $this->createMock(Stopwatch::class);

        $stopwatch->method('start')->willReturn(true);
        $stopwatch->method('stop')->willReturn(true);

        return $stopwatch;
    }

    public function testSomething()
    {
        $object = new \stdClass();
        $repository = $this->createMock(EntityRepository::class);

        $repository->expects($this->any())
            ->method('__call')
            ->with('findOneByUsername')
            ->willReturn($object);

        $objectManager = $this->createMock(ObjectManager::class);

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($repository);


        $testService = new TestService($objectManager, $this->cacheMock(), $this->loggerMock(), $this->stopwatchMock());

        $this->assertEquals('sarlanga', $testService->something('sarlanga'));
    }
}
