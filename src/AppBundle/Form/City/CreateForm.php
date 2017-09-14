<?php

namespace AppBundle\Form\City;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
                'name',
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [new NotBlank()]
                ]
            )->add(
                'short_name',
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [new NotBlank()]
                ]
            )->add(
                'picture_link',
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [new NotBlank()]
                ]
            )->add(
                'has_subway',
                CheckboxType::class,
                [
                    'required'    => false
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
