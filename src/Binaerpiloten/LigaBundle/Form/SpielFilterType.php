<?php

namespace Binaerpiloten\LigaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class SpielFilterType extends AbstractType
{
	
		protected $em;
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    		$date = new \DateTime();
    	
        $builder
            ->add('year','choice', array(
            		'expanded' => true,
            		'multiple' => true,
            		'choices' => $this->getYearConstants()))
            ->add('volk','entity',array(
        			'multiple' => true,
            	'expanded' => true,
            	'required' => false,
            	'class' => 'BinaerpilotenLigaBundle:Volk',
            	'query_builder' => function(EntityRepository $er) {
        						return $er->createQueryBuilder('pp');
        					},
        			))
        		->add('mission','entity',array(
        					'multiple' => true,
        					'expanded' => true,
        					'required' => false,
        					'class' => 'BinaerpilotenLigaBundle:Mission',
        					'query_builder' => function(EntityRepository $er) {
        						return $er->createQueryBuilder('pp');
        					},
        			))
        		->add('spieler','entity',array(
        			'multiple' => true,
            	'expanded' => true,
            	'required' => false,
            	'class' => 'BinaerpilotenLigaBundle:User',
            	'query_builder' => function(EntityRepository $er) {
        						return $er->createQueryBuilder('pp');
        					},
        			))
      			
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Binaerpiloten\LigaBundle\Entity\SpielFilter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'binaerpiloten_ligabundle_filter';
    }
    
    public function __construct($em){
    	$this->em = $em;
    }
    
    public function getYearConstants() {
    	$qyear = $this->em->createQuery("SELECT DISTINCT s.datum " .
    			"FROM Binaerpiloten\LigaBundle\Entity\Spiel s ");
    	 
    	$entities = $qyear->getResult();
    	$ret = array();
    	
    	foreach ($entities as $e) {
    		$in = $e['datum']->format('Y');
    		$ret[$in] = $in;
    	}
    	
    	krsort($ret);
    	
    	return $ret;
    }
}
