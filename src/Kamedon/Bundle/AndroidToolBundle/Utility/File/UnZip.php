<?php
namespace Kamedon\Bundle\AndroidToolBundle\Utility\File;


class UnZip implements ExtractToFileInterface
{

    public static function extractTo($file, $dir = './')
    {
        $zip = new \ZipArchive();
        if ($zip->open($file)) {
            $zip->extractTo($dir);
            $zip->close();
            return true;
        }
        throw new \RuntimeException('解凍できませんでした');
    }
}