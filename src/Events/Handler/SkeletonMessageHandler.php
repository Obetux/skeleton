<?php

namespace App\Events\Handler;

use Qubit\Bundle\RabbitBundle\Events\Message;
use Psr\Log\LoggerInterface as Logger;

/**
 * Created by PhpStorm.
 * User: cleyer
 * Date: 16/01/2018
 * Time: 11:51
 */
class SkeletonMessageHandler
{
    protected $log = null;

    /**
     * EventHandler constructor.
     * @param Logger $log
     */
    public function __construct(Logger $log)
    {
        $this->log = $log;
    }

    public function execute(Message $msg)
    {
        $this->log->info('Llega mensaje');
        /* IMPORTANTE:
         * Es el handler de la app, el encargado de retornar TRUE en caso de exito
         * y FALSE en caso de error generando su debido log
         * Si devuelve TRUE, el mensaje es eliminado de la cola.
         * Si es FALSE, el mensaje no se elimina de la cola y se reintenta.
         */
        //        $result = doSomethingMethod((array)$msg->getPayload());
        $result = true;

        if (!result) {
            $this->log->error('Error con mensaje, reintentar!!!');
            return false;
        }
        return true;
    }

}