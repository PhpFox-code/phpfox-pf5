<?php

namespace Neutron\Core\Service;


use Phpfox\Session\SessionFactoryInterface;

class SessionFactory implements SessionFactoryInterface
{
    public function factory()
    {
        $ref = $this->getConfigs();
        $class = \Phpfox::getParam('session.drivers', $ref['driver']);

        return new $class($ref['configs']);
    }

    /**
     * @return array
     * @ignore
     */
    protected function getConfigs()
    {
        $row = \Phpfox::db()->select('*')
            ->from(':core_session_driver')
            ->where('is_default=?', 1)
            ->limit(1, 0)
            ->execute()
            ->first();

        $configs = [];

        if (!empty($row['json_configs'])) {
            $configs = json_decode($row['json_configs'], true);
        }

        $driver = $row['driver'];

        return [
            'driver'  => $driver,
            'configs' => $configs,
        ];
    }
}