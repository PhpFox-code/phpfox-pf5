<?php

namespace Phpfox\Action;


class ActionRequestFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $_SERVER = [
            'SCRIPT_FILENAME' => 'index.php',
            'SCRIPT_NAME'     => 'index.php',
            'DOCUMENT_ROOT'   => '',
            'SERVER_PROTOCOL' => 'https',
            'PATH_INFO'       => '',
            'REDIRECT_URL'    => '/path/index.php/to/any',
            'REQUEST_METHOD'  => 'GET',
            'HTTP_HOST'       => 'www.example.com',
        ];
        $request = (new ActionRequestFactory())->factory();

        $this->assertTrue($request instanceof ActionRequest);

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/to/any', $request->getUri());
        $this->assertEquals('http://', $request->getProtocol());
        $this->assertEquals('www.example.com', $request->getHost());

    }
}
