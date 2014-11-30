<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/11/08
 * Time: 19:50
 */

namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android;


/**
 * Class StringXmlData
 * Android strings xml resourceの１行のデータ
 * @package Kamedon\Bundle\AndroidToolBundle\Utility\Android
 */
class StringsResourceData
{
    const DEFAULT_LANG = 'default';

    /**
     * Android strings xml の値
     * @var string
     *
     */
    public $lang = self::DEFAULT_LANG;

    /**
     * Android strings xmlのname属性の値
     * @var string
     */
    public $name;
    /**
     * Android strings xml の値
     * @var string
     */
    public $value;

}