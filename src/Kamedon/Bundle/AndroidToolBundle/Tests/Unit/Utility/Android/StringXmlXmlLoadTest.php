<?php
namespace Kamedon\Bundle\AndroidToolBundle\Tests\Unit\Utility\Android;

use Kamedon\Bundle\AndroidToolBundle\Utility\Android\StringsResourceData;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\StringXmlResourceLoad;

class StringXmlResourceLoadTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var StringXmlResourceLoad
     */
    private $stringResourceRegister;

    protected function setUp()
    {
        $this->stringResourceRegister = new StringXmlResourceLoad();
    }


    /**
     * @test
     */
    public function Androidのstringsxmlのデータを解析()
    {
        $data = file_get_contents(__DIR__ . "/data/strings.xml");
        $ans = [
            'app_name' => '"SilentCamera"',
            'save_complete' => '"Image is successfully saved!"',
        ];
        $n = 0;
        /** @var StringsResourceData $resource */
        foreach (StringXmlResourceLoad::load($data) as $resource) {
            $n++;
            $this->assertSame($ans[$resource->name], $resource->value);
        }
        $this->assertSame($n, count($ans));
    }
}