<?php
namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\File;

use Kamedon\Bundle\AndroidToolBundle\Utility\File\UnZip;

/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/12/09
 * Time: 20:58
 */
class StringsZip extends AndroidResourceFile
{

    /** @var string */
    private $dir = './';

    /**
     * @return \Generator
     */
    public function read()
    {
        if (UnZip::extractTo($this->path, $this->dir)) {
            yield new StringsDir($this->dir);
        } else {
            throw new \RuntimeException();
        }
    }

    /**
     * @param string $dir
     * @return $this
     */
    public function to($dir)
    {
        $this->dir = $dir;
        return $this;
    }
}