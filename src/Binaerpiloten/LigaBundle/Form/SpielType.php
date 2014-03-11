<?php

namespace Binaerpiloten\LigaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SpielType extends AbstractType
{
		// constant = submitValue
		const Kreuzzug = "Kreuzzug";
		const Vernichtung = "Töte den Alien";
		const GroßeKannonen = "Große Kanonen ruhen nie";
		const Reinigung = "Die Reinigung";
		const WilleDesImperators = "Der Wille des Imperators";
		const Relikt = "Das Relikt";
		
		
		/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datum')
            ->add('mission', 'choice', array(
            		'choices' => $this->getMissionConstants()))
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
/* ========================== Helper functions go here! ================================= */
    public function getMissionConstants() {
    	return array(
    			//constant => label
    			self::Kreuzzug => 'Kreuzzug',
    			self::Vernichtung => 'Töte den Alien',
    			self::GroßeKannonen => 'Große Kanonen ruhen nie',
    			self::Reinigung => 'Die Reinigung',
    			self::WilleDesImperators => 'Der Wille des Imperators',
    			self::Relikt => 'Das Relikt',
    	);
    }
}