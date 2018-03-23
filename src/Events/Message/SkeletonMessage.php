<?php
namespace App\Events\Message;

use Qubit\Bundle\QubitMqBundle\Events\Message;

class SkeletonMessage extends Message
{
    public $component = 'COMPONENT';
    public $action = 'ACTION';
}