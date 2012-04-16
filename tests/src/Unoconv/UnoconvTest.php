<?php

namespace Unoconv;

require_once dirname(__FILE__) . '/../../../src/Unoconv/Unoconv.php';

/**
 * Test class for Unoconv.
 * Generated by PHPUnit on 2012-04-16 at 13:55:07.
 */
class UnoconvTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Unoconv\Unoconv::__construct
     */
    public function testConstruct()
    {
        $Unoconv = new Unoconv('unoconv', new \Monolog\Logger('test'));
        $Unoconv = new Unoconv('unoconv');
    }

    /**
     * @covers Unoconv\Unoconv::open
     */
    public function testOpen()
    {
        $Unoconv = new Unoconv('unoconv');
        $Unoconv->open(__DIR__ . '/../../files/Hello.odt');
    }

    /**
     * @covers Unoconv\Unoconv::open
     * @expectedException \Unoconv\Exception\InvalidFileArgumentException
     */
    public function testOpenFail()
    {
        $Unoconv = new Unoconv('unoconv');
        $Unoconv->open(__DIR__ . '/../../files/invalid.file');
    }

    /**
     * @covers Unoconv\Unoconv::saveAs
     */
    public function testSaveAs()
    {
        $dest = __DIR__ . '/../../files/Hello.pdf';

        $Unoconv = new Unoconv('unoconv');
        $Unoconv->open(__DIR__ . '/../../files/Hello.odt');
        $Unoconv->saveAs('pdf', $dest);

        $this->assertTrue(file_exists($dest));
        unlink($dest);
    }

    /**
     * @covers Unoconv\Unoconv::saveAs
     * @expectedException \Unoconv\Exception\RuntimeException
     */
    public function testSaveAsInvalidDest()
    {
        $dest = '/tmp/' . mt_rand(10000, 99999) . '/Hello.pdf';

        $Unoconv = new Unoconv('unoconv');
        $Unoconv->open(__DIR__ . '/../../files/Hello.odt');
        $Unoconv->saveAs('pdf', $dest);

        $this->assertTrue(file_exists($dest));
        unlink($dest);
    }

    /**
     * @covers Unoconv\Unoconv::saveAs
     * @expectedException \Unoconv\Exception\LogicException
     */
    public function testSaveAsWithoutFile()
    {
        $Unoconv = new Unoconv('unoconv');
        $Unoconv->saveAs('pdf', __DIR__ . '/../../files/Hello.pdf');
    }

    /**
     * @covers Unoconv\Unoconv::load
     */
    public function testLoad()
    {
        $Unoconv = Unoconv::load();
    }

}
