<?php
namespace Kamedon\Bundle\AndroidToolBundle\Tests\Unit\Utility\File;

use Kamedon\Bundle\AndroidToolBundle\Utility\File\UnZip;

class UnZipTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function Zip解凍テスト()
    {
        $date = new \DateTime();
        $baseDir = __DIR__ . '/../../../Data';
        $filePath = $baseDir . '/values.zip';
        $dir = $baseDir . '/temp/' . $date->format('YmdHis') . '/';
        $this->assertTrue(file_exists($filePath), 'ファイルが存在していません');
        UnZip::extractTo($filePath, $dir);
    }

}