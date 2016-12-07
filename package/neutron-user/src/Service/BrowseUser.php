<?php

namespace Neutron\User\Service;

use Neutron\User\Model\User;

class BrowseUser
{
    /**
     * @param $userId
     *
     * @return User
     */
    public function findUserById($userId)
    {
        return \Phpfox::getDb()
            ->select('*')
            ->from(':user')
            ->where('user_id=?', (int)$userId)
            ->limit(1, 0)
            ->execute()
            ->setPrototype(User::class)
            ->first();
    }
}