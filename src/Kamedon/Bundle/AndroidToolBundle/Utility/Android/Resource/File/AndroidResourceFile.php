<?php
namespace Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\File;

/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/12/09
 * Time: 20:58
 */

abstract class AndroidResourceFile implements FileInterface
{
    /** @var  string */
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

}