<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/11/30
 * Time: 16:26
 */

namespace Kamedon\Bundle\AndroidToolBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class UploadFileType extends AbstractType{

    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file')
            ->add('upload', 'submit');
    }



    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'upload_file';
    }

}