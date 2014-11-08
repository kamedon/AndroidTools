<?php
namespace Kamedon\Bundle\AndroidToolBundle\Utility\File;


class UnZip implements ExtractToFileInterface
{

    /**
     * @param $file
     * @param string $dir
     * @return bool
     */
    public static function extractTo($file, $dir = './')
    {
        $zip = new \ZipArchive();
        if (is_file($file)) {
            if ($zip->open($file)) {
                $zip->extractTo($dir);
                $zip->close();
                return true;
            } else {
                return false;
            }
        }
        throw new \RuntimeException('ファイルではありません');
    }
}