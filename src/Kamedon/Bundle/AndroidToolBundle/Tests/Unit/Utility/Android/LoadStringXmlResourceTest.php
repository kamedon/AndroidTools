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
    public function zipリソースデータのstringxmlのデータを取得()
    {
        $date = new \DateTime();
        $zip = __DIR__ . '/../../../Data/values.zip';
        $dir = __DIR__ . '/../../../Data/temp/' . $date->format('YmdHis');
        $ans =
            [
                'app_name' => ['"SilentCamera"', '"サイレントカメラ"'],
                'save_complete' => [
                    '"Image is successfully saved!"',
                    '"保存が完了しました"',
                    '"저장"',
                    '"salvo"',
                    '"Сохраненный"',
                    '"保存"'
                ],
            ];
        $langs = [StringsResourceData::DEFAULT_LANG, 'ja', 'pt', 'ru', 'zh', 'ko'];
        /** @var StringsResourceData $resource */
        foreach (LoadStringXmlResource::loadZip($zip, $dir) as $resource) {
            $this->assertTrue(in_array($resource->value, $ans[$resource->name]), $resource->value . ":not found value:".$resource->value);
            $this->assertTrue(in_array($resource->lang, $langs), $resource->lang . ":not found Lang:".$resource->name);
        }
        system("rm -rf {$dir}");
    }

    /**
     * @test
     */
    public function ディレクトリ以下のstringxmlのデータを取得()
    {
        $dir = __DIR__ . '/../../../Data/values_sample';
        $ans =
            [
                'app_name' => ['"SilentCamera"', '"サイレントカメラ"'],
                'save_complete' => [
                    '"Image is successfully saved!"',
                    '"保存が完了しました"',
                    '"저장"',
                    '"salvo"',
                    '"Сохраненный"',
                    '"保存"'
                ],
            ];
        $langs = [StringsResourceData::DEFAULT_LANG, 'ja', 'pt', 'ru', 'zh', 'ko'];

        /** @var StringsResourceData $resource */
        foreach (LoadStringXmlResource::loadDir($dir) as $resource) {
            $this->assertTrue(in_array($resource->value, $ans[$resource->name]));
            $this->assertTrue(in_array($resource->lang, $langs), $resource->lang . ":not found");
        }
    }


    /**
     * @test
     */
    public function Androidのstringsxmlのデータを解析()
    {
//        $data = file_get_contents(__DIR__ . "/data/strings.xml");
        $path = __DIR__ . '/../../../Data/strings.xml';
        $data = file_get_contents($path);
        $ans = [
            'app_name' => '"SilentCamera"',
            'save_complete' => '"Image is successfully saved!"',
        ];
        $n = 0;
        /** @var StringsResourceData $resource */
        foreach (LoadStringXmlResource::parse($data) as $resource) {
            $n++;
            $this->assertSame($ans[$resource->name], $resource->value);
        }
        $this->assertSame($n, count($ans));
    }
}