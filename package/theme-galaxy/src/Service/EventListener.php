<?php

namespace Neutron\ThemeGalaxy\Service;


use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{

    public function __call($name, $arguments)
    {
        // do nothing
    }
}