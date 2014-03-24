<?php

namespace Binaerpiloten\LigaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Binaerpiloten\LigaBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class SpielType extends AbstractType
{
	
		private $you;
		private $enemy;
		private $em;
		
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
            ->add('datum','date',array('data' => new \DateTime()))
            ->add('mission','entity', array(
            	'class' => 'BinaerpilotenLigaBundle:Mission',
            	'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('pp');
              },)
            )
            ->add('youpunkte')
            ->add('enemypunkte')
            ->add('youarmee','entity', array(
            	'class' => 'BinaerpilotenLigaBundle:Armee',
            	'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('pp')->where("pp.user = ".$this->you->getId());
              },)	
            )
            ->add('enemyarmee','entity', array(
            	'class' => 'BinaerpilotenLigaBundle:Armee',
            	'query_builder' => function(EntityRepository $er) {
            		return $er->createQueryBuilder('pp')->where("pp.user = ".$this->enemy->getId());
            	},)
            )
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
    
    public function __construct($em,$y,$e){
    	$this->em = $em;
    	$this->you = $y;
    	$this->enemy = $e;
    }
/* ========================== Helper functions go here! ================================= */
    public function getMissionConstants() {
    	$qmission = $this->em->createQuery("SELECT m " .
    			"FROM Binaerpiloten\LigaBundle\Entity\Mission m ");
    	 
    	$entities = $qmission->getResult();
    	$ret = array();
    	
    	foreach ($entities as $e) {
    		$in = $e->getName();
    		$ret[$in] = $in;
    	}
    	
    	return $ret;
    }
}