<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/12/09
 * Time: 21:56
 */

namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\File;


interface FileInterface
{
    /**
     * @return \Generator
     */
    public function read();

}