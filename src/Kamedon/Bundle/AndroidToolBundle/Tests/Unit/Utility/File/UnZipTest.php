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
        $path = __DIR__ . '/../Android/data/values.zip';
        $dir = __DIR__ . '/../Android/data/' . $date->format('YmdHis').'/';
        $this->assertTrue(file_exists($path), 'ファイルが存在していません');
        UnZip::extractTo($path, $dir);
    }

}