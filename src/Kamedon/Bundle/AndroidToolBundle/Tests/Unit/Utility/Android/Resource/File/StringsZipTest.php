<?php
use Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\Strings\StringsDir;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\Strings\StringsZip;

/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/12/09
 * Time: 21:07
 */
class StringsZipTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function zipリソースデータのstringxmlのデータを取得()
    {
        $date = new \DateTime();
        $path = __DIR__ . '/../../../../../Data/values.zip';
        $dir = __DIR__ . '/../../../../../Data/temp/' . $date->format('YmdHis');
        $zip = new StringsZip($path);
        $generator = $zip->to($dir)->read();

        $n = 0;
        /** @var StringsDir $resource */
        foreach ($generator as $resource) {
            $n++;
        }
        $this->assertTrue(is_dir($dir));
        $this->assertSame(1, $n);
        system("rm -rf {$dir}");
    }

}