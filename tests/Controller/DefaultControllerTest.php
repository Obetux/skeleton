<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function checkProfiler($profile)
    {
//error_log(print_r($profile->getCollector('logger')->countDeprecations()));exit;
//var_dump(get_class_methods($profile->getCollector('logger')));exit;
//var_dump($profile);exit;
        // Check that the profiler is enabled
        if ($profile) {
            // check the number of requests
            $this->assertLessThan(
                5,
                $profile->getCollector('db')->getQueryCount(),
                sprintf(
                    'Checks that query count is less than 5 (token %s)',
                    $profile->getToken()
                )
            );
            $spentTime = 450;
            // check the time spent in the framework
            $this->assertLessThan(
                $spentTime,
                $profile->getCollector('time')->getDuration(),
                sprintf(
                    'Checks that request time is less than '.$spentTime.' (token %s)',
                    $profile->getToken()
                )
            );

            $this->assertEquals(
                0,
                $profile->getCollector('logger')->countDeprecations(),
                sprintf(
                    'Checks Deprecations (token %s)',
                    $profile->getToken()
                )
            );
        }
    }

    public function testSomething()
    {
        $client = static::createClient();
        // Enable the profiler for the next request
        // (it does nothing if the profiler is not available)
        $client->enableProfiler();
        $crawler = $client->request('GET', '/api/default/test?test=sarlanga');

        // Assert that the "Content-Type" header is "application/json"
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is not "application/json"' // optional message shown on failure
        );

        // Assert that the "x-content" header exist
        $this->assertTrue(
            $client->getResponse()->headers->has(
                'x-context'
            ),
            'the "x-context" header not exist' // optional message shown on failure
        );
//        var_dump($client->getResponse()->getStatusCode());exit;
        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is not 2xx');

        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );

        $this->checkProfiler($client->getProfile());
    }
}
