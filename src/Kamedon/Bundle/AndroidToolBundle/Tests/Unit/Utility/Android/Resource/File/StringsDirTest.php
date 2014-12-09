<?php
use Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\AndroidLang;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\File\StringsDir;

/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/12/09
 * Time: 21:07
 */
class StringsDirTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function ディレクトリ以下のstringxmlのデータを取得()
    {
        $dirPath = __DIR__ . '/../../../../../Data/values_sample';
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

        $dir = new StringsDir($dirPath);
        $dirCount = 0;
        /** @var AndroidString $resource */
        foreach ($dir->read() as $resource) {
            $this->assertTrue(in_array($resource->getLang(), $langs), $resource->getLang() . ":not found");
            $dirCount++;
        }
        $this->assertSame(count($langs), $dirCount);
    }
}
