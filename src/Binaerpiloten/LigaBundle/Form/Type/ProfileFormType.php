<?php

namespace Binaerpiloten\LigaBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // add your custom field
    		$builder->add('username');
    		$builder->add('email');
        $builder->add('vorname');
        $builder->add('nachname');
    }

    public function getName()
    {
        return 'liga_user_profile';
    }
}