<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/11/09
 * Time: 1:21
 */

namespace Kamedon\Bundle\AndroidToolBundle\Tests\Unit\Utility\Android;


use Kamedon\Bundle\AndroidToolBundle\Utility\Android\FindStringXmlResource;

class FindStringXmlResourceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function ディレクトリ以下のstringリソースを取得する()
    {
        $path = __DIR__ . '/data/values_sample';
        $ans = [
            $path . '/values/' . FindStringXmlResource::STRING_XML_RESOURCE_NAME,
            $path . '/values-ja/' . FindStringXmlResource::STRING_XML_RESOURCE_NAME,
            $path . '/values-ko/' . FindStringXmlResource::STRING_XML_RESOURCE_NAME,
            $path . '/values-pt/' . FindStringXmlResource::STRING_XML_RESOURCE_NAME,
            $path . '/values-ru/' . FindStringXmlResource::STRING_XML_RESOURCE_NAME,
            $path . '/values-zh/' . FindStringXmlResource::STRING_XML_RESOURCE_NAME,
        ];
        $n = 0;
        foreach (FindStringXmlResource::find($path) as $file) {
            $this->assertTrue(in_array($file, $ans));
            $n++;
        }
        $this->assertSame(count($ans), $n);
    }

}