<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/12/09
 * Time: 21:50
 */

namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\File;


use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class StringsDir extends AndroidResourceFile
{
    const STRING_XML_RESOURCE_FILE_NAME = 'strings.xml';

    /**
     * @return \Generator
     */
    public function read()
    {
        $finder = new Finder();
        $iterator = $finder
            ->in($this->path)
            ->name(self::STRING_XML_RESOURCE_FILE_NAME)
            ->files();

        /** @var SplFileInfo $fileInfo */
        foreach ($iterator as $fileInfo) {
            $xml = new StringsXml($fileInfo->getPath());
            yield $xml;
        }
    }
}