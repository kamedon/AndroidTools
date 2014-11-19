<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/11/08
 * Time: 20:15
 */

namespace Kamedon\Bundle\AndroidToolBundle\Utility\File;


interface ExtractToFileInterface
{
    public static function extractTo($file, $dir = './');
}