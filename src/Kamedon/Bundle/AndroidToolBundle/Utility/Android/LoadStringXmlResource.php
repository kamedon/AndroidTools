<?php
namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android;

use Kamedon\Bundle\AndroidToolBundle\Utility\File\UnZip;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Form\Exception\RuntimeException;

/**
 * string.xmlの解析
 * Class LoadStringXmlResource
 * @package Kamedon\Bundle\AndroidToolBundle\Utility\Android
 */
class LoadStringXmlResource
{
    /**
     * zipから一行のリソースデータのGeneratorを作る
     * @param $zipFile
     * @param string $dir
     * @return \Generator
     */
    public static function loadZip($zipFile, $dir = './')
    {
        if (UnZip::extractTo($zipFile, $dir)) {
            foreach (self::loadDir($dir) as $resource) {
                yield $resource;
            }
        } else {
            throw new \RuntimeException();
        }
    }

    /**
     * ディレクトリ以下からリソースデータのGeneratorを作る
     * @param $dir
     * @return \Generator StringsResourceData
     */
    public static function loadDir($dir)
    {
        /** @var SplFileInfo $file */
        foreach (FindStringXmlResource::find($dir) as $file) {
            $data = file_get_contents($file->getPathname());
            $path = explode('/', $file->getPath());
            preg_match("/values-?(.*)/", $path[count($path) - 1], $res);
            $lang = $res[1];
            /** @var StringsResourceData $resource */
            foreach (self::parse($data) as $resource) {
                if(!empty($lang)){
                    $resource->lang = $lang;
                }
                yield $resource;
            }
        }

    }

    /**
     * string.xmlをパースし、Generatorを作る
     * @param $data
     * @return \Generator StringsResourceData
     */
    public static function parse($data)
    {
        $xml = simplexml_load_string($data);
        foreach ($xml->string as $resource) {
            $data = new StringsResourceData();
            $data->name = (string)$resource->attributes()->name;
            $data->value = (string)$resource;
            yield $data;
        }
    }


}
