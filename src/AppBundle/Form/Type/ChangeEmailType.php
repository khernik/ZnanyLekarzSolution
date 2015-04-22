<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ChangeEmailType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldEmail', 'text', [
            'required' => true,
            'label'    => 'Old email',
            'mapped'   => false
        ]);

        $builder->add('newEmail', 'text', [
            'required' => true,
            'label'    => 'New email',
            'mapped'   => false
        ]);

        $builder->add('repeatEmail', 'text', [
            'required' => true,
            'label'    => 'Repeat email',
            'mapped'   => false
        ]);

        $builder->add('Change email', 'submit');
    }

    public function getName()
    {
        return 'ChangeEmailType';
    }

} // End ChangeEmailType
