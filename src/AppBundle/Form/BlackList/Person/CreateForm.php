<?php

namespace AppBundle\Form\BlackList\Person;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
            'id',
            TextType::class,
            [
                'required'    => true,
                'constraints' => [new NotBlank()]
            ]
        )->add(
            'submit',
            SubmitType::class
        );
    }

    public function getName()
    {
        return 'person';
    }
}
