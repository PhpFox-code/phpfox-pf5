<?php

namespace Phpfox\Logger;


class LogContainerFactory
{
    function factory($class = null, $key = null)
    {
        if (!$class) {
            ;
        }

        if (!$key) {
            $key = 'log.main';
        }

        $drivers = \Phpfox::getParams('log.drivers');
        $containers = \Phpfox::getParams('log.containers');
        $loggerOptions = $containers[$key];

        $container = new LogContainer();

        foreach ($loggerOptions as $loggerOption) {
            $driver = $drivers[$loggerOption['driver']];
            $container->add(new $driver($loggerOption));
        }
        return $container;
    }
}