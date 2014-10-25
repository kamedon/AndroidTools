<?php
namespace Kamedon\Bundle\AndroidToolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/10/25
 * Time: 14:21
 */
class ChildrenStringResourceType extends AbstractType
{

    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lang')
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