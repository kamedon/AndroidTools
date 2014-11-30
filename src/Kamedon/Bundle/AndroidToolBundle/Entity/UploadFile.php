<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/11/30
 * Time: 16:28
 */

namespace Kamedon\Bundle\AndroidToolBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

class UploadFile
{
    /**
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/zip" },
     *     mimeTypesMessage = "Please upload a valid Zip"
     * )
     */
    protected $file;

    public function setFile(File $file = null)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

}