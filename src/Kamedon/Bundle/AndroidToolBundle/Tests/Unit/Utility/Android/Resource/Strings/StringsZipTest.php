<?php
use Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\AndroidLang;
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
    public function zipリソースデータを解凍()
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

    /**
     * @test
     */
    public function zipリソースデータのstringデータを取得()
    {
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
        $langs = [AndroidLang::LANG_DEFAULT, 'ja', 'pt', 'ru', 'zh', 'ko'];

        $date = new \DateTime();
        $path = __DIR__ . '/../../../../../Data/values.zip';
        $dir = __DIR__ . '/../../../../../Data/temp/' . $date->format('YmdHis');
        $zip = new StringsZip($path);
        $generator = $zip->to($dir)->load();

        $stringCount = 0;
        /** @var AndroidString $resource */
        foreach ($generator as $resource) {
            $this->assertTrue(in_array($resource->getLang(), $langs), $resource->getLang() . ":not found");
            $this->assertTrue(in_array($resource->getValue(), $ans[$resource->getAttr()]), $resource->getLang() . ":" . $resource->getValue() . ":not found");
            $stringCount++;
        }
        $this->assertSame(count($langs) * count($ans), $stringCount);
        system("rm -rf {$dir}");
    }

}