<?php

namespace AppBundle\Form\ParseList;

use AppBundle\Document\ParseList\Source;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class SourceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'type',
                ChoiceType::class,
                [
                    'required'    => true,
                    'constraints' => [new NotBlank()],
                    'choices'     => [
                        Source::TYPE_VK_COMMENT => Source::TYPE_VK_COMMENT,
                        Source::TYPE_VK_WALL    => Source::TYPE_VK_WALL,
                    ]
                ]
            )->add(
                'link',
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [new NotBlank()]
                ]
            )->add(
                'parameters',
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
        return 'parse';
    }
}
