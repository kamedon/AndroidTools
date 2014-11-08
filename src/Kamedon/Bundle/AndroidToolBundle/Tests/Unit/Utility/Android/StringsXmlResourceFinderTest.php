<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/11/08
 * Time: 20:46
 */

namespace Kamedon\Bundle\AndroidToolBundle\Tests\Unit\Utility\Android;


use Kamedon\Bundle\AndroidToolBundle\Utility\Android\StringsXmlResourceFinder;

class StringsXmlResourceFinderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function ディレクトリ内にstring_xmlを探す()
    {
        $dir = __DIR__ . '/data/20141108204856/';
        StringsXmlResourceFinder::find($dir);
        $this->fail('test');
    }

}