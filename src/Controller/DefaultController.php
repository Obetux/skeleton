<?php

namespace App\Controller;

use App\Events\Message\SkeletonMessage;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Qubit\Bundle\UtilsBundle\Context\Context;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Stopwatch\Stopwatch;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Qubit\Bundle\UtilsBundle\Annotations\ContextCheck;
use App\Model\Test;

/*
 * Puedo Dentro de las anotaciones de Clase o de metodo validar el contexto con
 * @ContextCheck(type="INIT") o @ContextCheck(type="AUTH")
 */
/**
 * Class DefaultController
 * @package App\Controller
 *
 * @Route("/api/default")
 *
 */
class DefaultController extends Controller
{
    private $stopwatch;
    private $eventProducer;

    /**
     * DefaultController constructor.
     * @param Stopwatch $stopwatch
     * @param $eventProducer
     */
    public function __construct(Stopwatch $stopwatch, $eventProducer)
    {
        $this->stopwatch = $stopwatch;
        $this->eventProducer = $eventProducer;
    }

    /**
     * @GET("/test", name="test")
     * @QueryParam(name="test", strict=false,  nullable=true, description="Service")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Sarlanga",
     *     @Model(type=Test::class)
     * )
     * @SWG\Tag(name="TEST")
     *
     * @param ParamFetcher $paramFetcher
     *
     * @return JsonResponse
     */
    public function test(ParamFetcher $paramFetcher)
    {
        // INICIO BLOQUE DE STOPWATCH PARA EL PROFILES
        $this->stopwatch->start('TestController::test');

        // OBTENGO PARAMETROS
        $test =  $paramFetcher->get('test');


        $sarlanga = $this->get('App\Service\TestService')->something($test);
        /*
         * INVOCO SERVICIO Y HAGO LO QUE NECESITO
        .......
        */
        /*
         MANIPUTLO EL CONTEXTO SI NECESITO
        $this->stopwatch->start('Context::initialize');

        PUEDE OBTENERSE DESDE EL CONTEXTMANAGER O COMO SINGLETON
        $context = Context::getInstance();
        $context = $this->get('qubit.context.manager')->getContext();

        $context->setService($service);
        $context->setVertical($service);
        $context->setIpAddress($ipAddress);
        $context->setUserAgent($userAgent);
        $context->setRegion($geoIp["region"]);

        $this->stopwatch->stop('Context::initialize');
        */

        $this->stopwatch->stop('TestController::test');

        return $this->json(['test' => $sarlanga]);
    }

    /**
     * @Get("/sendMessage")
     */
    public function sendMessage()
    {
        $message = new SkeletonMessage();
        $message->setPayload(['test' => 'test']);

        $this->eventProducer->publish($message);
        return $this->json(true);
    }
}
