<?php
use Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\File\StringsXml;

/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/12/09
 * Time: 21:07
 */
class StringsXmlTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function Androidのstringsxmlのデータを解析()
    {
        $path = __DIR__ . '/../../../../../Data/strings.xml';
        $ans = [
            'app_name' => '"SilentCamera"',
            'save_complete' => '"Image is successfully saved!"',
        ];
        $xml = new StringsXml($path);
        $n = 0;
        /** @var AndroidString $resource */
        foreach ($xml->read() as $resource) {
            $n++;
            $this->assertSame($ans[$resource->getAttr()], $resource->getValue());
        }
        $this->assertSame($n, count($ans));
    }

}