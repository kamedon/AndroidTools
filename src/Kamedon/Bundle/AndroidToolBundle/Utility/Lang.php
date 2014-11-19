<?php

namespace Kamedon\Bundle\AndroidToolBundle\Utility;
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/10/26
 * Time: 15:09
 */
class Lang
{
    const LANG_ENGLISH = 'en';
    const LANG_JAPANESE = 'ja';
    const LANG_ITALIAN = 'li';

    public static function getLanguage()
    {
        return [self::LANG_JAPANESE => self::LANG_JAPANESE, self::LANG_ITALIAN => self::LANG_ITALIAN];
    }

} 