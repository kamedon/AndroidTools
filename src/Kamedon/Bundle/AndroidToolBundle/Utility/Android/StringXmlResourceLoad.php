<?php
namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android;

class StringXmlResourceLoad
{
    /**
     * @param $data
     * @return \Generator
     */
    public static function load($data)
    {
        $xml = simplexml_load_string($data);
        foreach ($xml->string as $s) {
            $data = new StringsResourceData();
            $data->name = (string)$s->attributes()->name;
            $data->value = (string)$s;
            yield $data;
        }
    }


}
