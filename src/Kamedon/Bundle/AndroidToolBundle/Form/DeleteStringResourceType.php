<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/10/25
 * Time: 17:14
 */

namespace Kamedon\Bundle\AndroidToolBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DeleteStringResourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('delete', 'submit');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'delete_string_resource';
    }
}