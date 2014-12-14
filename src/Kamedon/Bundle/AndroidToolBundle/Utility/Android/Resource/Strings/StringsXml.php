<?php
namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\Strings;

use Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\AndroidLang;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\AndroidResource;

/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/12/09
 * Time: 20:58
 */
class StringsXml extends AndroidResource
{

    /** @var string */
    private $lang = AndroidLang::LANG_DEFAULT;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        parent::__construct($path);
        $path = explode('/', $this->path);
        preg_match("/values-?(.*)/", $path[count($path) - 2], $res);
        if (!empty($res[1])) {
            $this->lang = $res[1];
        }
    }


    /**
     * @return \Generator
     */
    public function read()
    {
        $contents = file_get_contents($this->path);
        $xml = simplexml_load_string($contents);
        foreach ($xml->string as $resource) {
            $string = new AndroidString();
            $string->setAttr((string)$resource->attributes()->name);
            $string->setValue((string)$resource);
            yield $string;
        }
    }

    /**
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * @return \Generator
     */
    public function load()
    {
        foreach($this->read() as $string){
            yield $string;
        }
    }
}