<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/11/08
 * Time: 20:54
 */

namespace Kamedon\Bundle\AndroidToolBundle\Utility\File;


class FindFile
{
    /**
     * 再帰的に指定フォルダ以下からファイル名の完全一致からファイルを探す
     * @param $dir
     * @param $filename
     * @return \Generator
     */
    public static function find($dir, $filename)
    {
        foreach (self::ls($dir) as $data) {
            if ($data['name'] === $filename) {
                yield $data;
            }
        }
    }

    /**
     * 再帰的に指定フォルダ以下のファイル一覧を取得
     * @param $dir
     * @return \Generator
     */
    public static function ls($dir)
    {
        $files = scandir($dir);
        $files = array_filter($files, function ($file) {
            return !in_array($file, array('.', '..'));
        });
        foreach ($files as $file) {
            $fullPath = rtrim($dir, '/') . '/' . $file;
            if (is_dir($fullPath)) {
                foreach (self::ls($fullPath) as $res) {
                    yield $res;
                }
            } else {
                yield ['dir' => $dir . '/', 'name' => $file];
            }
        }

    }


}