<?php

namespace AppBundle\Form\BlackList;

use Schema\BlackList\Record;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                'regexp',
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [new NotBlank()]
                ]
            )->add(
                'type',
                ChoiceType::class,
                [
                    'required'    => true,
                    'constraints' => [new NotBlank()],
                    'choices'     => [
                        'phone'       => Record::TYPE_PHONE,
                        'person'      => Record::TYPE_PERSON,
                        'description' => Record::TYPE_DESCRIPTION
                    ]

                ]
            )->add(
                'submit',
                SubmitType::class
            );
    }

    public function getName()
    {
        return 'city';
    }
}
