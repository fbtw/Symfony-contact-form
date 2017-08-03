<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('de', EmailType::class)
            ->add('mensaje', TextareaType::class,[
                'attr' => ['rows'=> 8 ,]
                ])
            ->add('mandar', SubmitType::class,[
                'attr' => ['class' => 'btn btn-success btn-block' ]
                ]);
    }
}
