<?php

namespace Binaerpiloten\LigaBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('vorname');
        $builder->add('nachname');
    }

    public function getName()
    {
        return 'liga_user_registration';
    }
}