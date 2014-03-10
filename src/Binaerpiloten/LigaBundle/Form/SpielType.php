<?php

namespace Binaerpiloten\LigaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SpielType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datum')
            ->add('mission')
            ->add('youpunkte')
            ->add('enemypunkte')
            ->add('enemy')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Binaerpiloten\LigaBundle\Entity\Spiel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'binaerpiloten_ligabundle_spiel';
    }
}
