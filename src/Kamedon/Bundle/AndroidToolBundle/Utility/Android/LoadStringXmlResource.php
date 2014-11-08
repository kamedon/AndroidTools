<?php
namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android;

class LoadStringXmlResource
{
    /**
     * @param $data
     * @return \Generator StringsResourceData
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
