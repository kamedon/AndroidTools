<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/12/09
 * Time: 21:50
 */

namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\Strings;


use Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\AndroidResource;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class StringsDir extends AndroidResource
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
            $xml = new StringsXml($fileInfo->getPath().'/'.self::STRING_XML_RESOURCE_FILE_NAME);
            yield $xml;
        }
    }

    /**
     * @return \Generator
     */
    public function load()
    {
        /** @var StringsXml $xml */
        foreach ($this->read() as $xml) {
            /** @var AndroidString $string */
            foreach ($xml->read() as $string) {
                $string->setLang($xml->getLang());
                yield $string;
            }
        }
    }
}