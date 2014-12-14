<?php
namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\Strings;

use Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\AndroidResource;
use Kamedon\Bundle\AndroidToolBundle\Utility\File\UnZip;

/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/12/09
 * Time: 20:58
 */
class StringsZip extends AndroidResource
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

    /**
     * @return \Generator
     */
    public function load()
    {
        /** @var StringsDir $dir */
        foreach ($this->read() as $dir) {
            /** @var AndroidString $string */
            foreach($dir->load() as $string){
                yield $string;
            }
        }

    }
}