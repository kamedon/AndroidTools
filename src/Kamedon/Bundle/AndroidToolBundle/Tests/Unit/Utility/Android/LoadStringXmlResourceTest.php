<?php
namespace Kamedon\Bundle\AndroidToolBundle\Tests\Unit\Utility\Android;

use Kamedon\Bundle\AndroidToolBundle\Utility\Android\StringsResourceData;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\LoadStringXmlResource;

class LoadStringXmlResourceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var LoadStringXmlResource
     */
    private $stringResourceRegister;

    protected function setUp()
    {
        $this->stringResourceRegister = new LoadStringXmlResource();
    }


    /**
     * @test
     */
    public function Androidのstringsxmlのデータを解析()
    {
//        $data = file_get_contents(__DIR__ . "/data/strings.xml");
        $path= __DIR__ . '/../../../Data/strings.xml';
        $data = file_get_contents($path);
        $ans = [
            'app_name' => '"SilentCamera"',
            'save_complete' => '"Image is successfully saved!"',
        ];
        $n = 0;
        /** @var StringsResourceData $resource */
        foreach (LoadStringXmlResource::load($data) as $resource) {
            $n++;
            $this->assertSame($ans[$resource->name], $resource->value);
        }
        $this->assertSame($n, count($ans));
    }
}