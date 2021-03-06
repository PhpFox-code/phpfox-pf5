<?php

namespace Phpfox\Mailer;


class SystemMailTransportTest extends \PHPUnit_Framework_TestCase
{

    public function testSendMail()
    {
        $transport = new SystemMailTransport();

        $msg = new Message();
        $msg->exchangeArray([
            'from'    => ['nam.ngvan@gmail.com', 'nam nguyen'],
            'subject' => 'test subject',
            'body'    => 'test body',
            'altBody' => 'test alt body',
        ]);
        $msg->addTo('namnv@younetco.com', 'Nam Nguyen');
        $transport->send($msg);
    }
}
