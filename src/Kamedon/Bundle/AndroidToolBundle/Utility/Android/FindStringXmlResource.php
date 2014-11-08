<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/11/09
 * Time: 1:18
 */

namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android;


use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class FindStringXmlResource
{
    const STRING_XML_RESOURCE_NAME = 'strings.xml';

    /**
     * @param $dir
     * @return \Generator
     */
    public static function find($dir)
    {
        $finder = new Finder();
        $iterator = $finder
            ->in($dir)
            ->name(self::STRING_XML_RESOURCE_NAME)
            ->files();

        /** @var SplFileInfo $fileInfo */
        foreach ($iterator as $fileInfo) {
            yield $fileInfo;
        }

    }
}