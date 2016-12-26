<?php
namespace Phpfox\View;


class ViewLayoutTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $vl = new ViewLayout();
        $this->assertNull($vl->getPageName());

        $vl->setPageName('master/layout/index');

        $this->assertEquals('master/layout/index', $vl->getPageName());

        $this->assertNull($vl->getTemplate());

        $this->assertEmpty($vl->getVariables());

        $vl->setTemplate('template1');

        $this->assertEquals('template1', $vl->getTemplate());

        $vl->setVariables(['k1' => 'v1', 'k2' => 'v2']);

        $this->assertEquals(['k1' => 'v1', 'k2' => 'v2'], $vl->getVariables());

        $vl->assign(['k2' => 'v2.', 'k3' => 'v3']);

        $this->assertEquals(['k1' => 'v1', 'k2' => 'v2.', 'k3' => 'v3'],
            $vl->getVariables());

        $vl->setTemplate('');

        $this->assertEquals('', $vl->render());

        $vl->terminate();
    }

    public function testBase2()
    {
        $vl = new ViewLayout();

        $vl->prepare();

        $this->assertEquals($vl->getTemplate(), 'layout.master.default');
    }
}
