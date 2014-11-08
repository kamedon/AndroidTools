<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/11/08
 * Time: 20:58
 */

namespace Kamedon\Bundle\AndroidToolBundle\Tests\Unit\Utility\File;


use Kamedon\Bundle\AndroidToolBundle\Utility\File\FindFile;

class FindFileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function dir配下のファイルを検索する()
    {
        $dir = __DIR__ . '/../Android/data/20141108204856';
        $this->isTrue(is_dir($dir), 'フォルダがありません');
        foreach (FindFile::find($dir, 'strings.xml') as $filepath) {
            var_dump($filepath);
        }
//        $this->fail("test");

    }

}