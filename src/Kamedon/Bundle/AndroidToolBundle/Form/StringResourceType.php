<?php
/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/10/25
 * Time: 15:58
 */

namespace Kamedon\Bundle\AndroidToolBundle\Form;


use Symfony\Component\Form\AbstractType;

class StringResourceType extends AbstractType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value')
            ->add('save', 'submit');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'string_resource';
    }

} 