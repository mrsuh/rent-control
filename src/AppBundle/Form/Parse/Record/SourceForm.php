<?php

namespace AppBundle\Form\Parse\Record;

use Schema\Parse\Record\Source;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
            )->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();

                $parameters = $data->getParameters();

                $decoded = json_decode($parameters, true);

                if(!is_array($decoded)) {
                    $form->get('parameters')->addError(new FormError('Invalid json'));
                }

                return true;
            });
    }

    public function getName()
    {
        return 'parse';
    }
}
