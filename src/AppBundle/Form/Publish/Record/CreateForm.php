<?php

namespace AppBundle\Form\Publish\Record;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
                'city',
                ChoiceType::class,
                [
                    'required'    => true,
                    'constraints' => [new NotBlank()],
                    'choices'     => $options['cities']
                ]
            )->add(
                'user',
                ChoiceType::class,
                [
                    'required'    => true,
                    'constraints' => [new NotBlank()],
                    'choices'     => $options['users']
                ]
            )->add(
                'group_id',
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [new NotBlank()]
                ]
            )->add(
                'link',
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
        return 'publish';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['cities', 'users']);
    }
}
