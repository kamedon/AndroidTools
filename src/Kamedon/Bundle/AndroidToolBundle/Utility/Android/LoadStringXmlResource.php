<?php
namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android;

use Kamedon\Bundle\AndroidToolBundle\Utility\File\UnZip;
use Symfony\Component\Form\Exception\RuntimeException;

class LoadStringXmlResource
{
    /**
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
        }else{
            throw new \RuntimeException();
        }
    }

    /**
     * @param $dir
     * @return \Generator StringsResourceData
     */
    public static function loadDir($dir)
    {
        foreach (FindStringXmlResource::find($dir) as $file) {
            $data = file_get_contents($file);
            foreach (self::parse($data) as $resource) {
                yield $resource;
            }
        }

    }

    /**
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
