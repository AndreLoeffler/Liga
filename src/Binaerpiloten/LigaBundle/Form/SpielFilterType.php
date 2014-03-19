<?php

namespace Binaerpiloten\LigaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class SpielFilterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    		$date = new \DateTime();
    	
        $builder
            ->add('year','integer',array('data'=> $date->format('Y'), 'required' => false,))
            ->add('volk','entity',array(
        			'multiple' => false,
            	'expanded' => true,
            	'required' => false,
            	'class' => 'BinaerpilotenLigaBundle:Volk',
            	'query_builder' => function(EntityRepository $er) {
        						return $er->createQueryBuilder('pp');
        					},
        			))
        		->add('volk2','entity',array(
        			'multiple' => false,
        			'expanded' => true,
        			'required' => false,
        			'class' => 'BinaerpilotenLigaBundle:Volk',
        			'query_builder' => function(EntityRepository $er) {
        						return $er->createQueryBuilder('pp');
        					},
        			))        			
        		->add('spieler','entity',array(
        			'multiple' => false,
            	'expanded' => true,
            	'required' => false,
            	'class' => 'BinaerpilotenLigaBundle:User',
            	'query_builder' => function(EntityRepository $er) {
        						return $er->createQueryBuilder('pp');
        					},
        			))
        			->add('spieler2','entity',array(
        					'multiple' => false,
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
}
