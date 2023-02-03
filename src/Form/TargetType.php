<?php

namespace App\Form;

use App\Entity\Target;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class TargetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('city')
            ->add('posterFile', VichFileType::class, [
                'required' => false,
                'download_uri' => false,
                'allow_delete' => false,
                'help' => 'Max size for image : 1Mb'
            ])
            ->add('isKilled', ChoiceType::class, [
                'choices' => [
                    'False' => false,
                    'True' => true,
                ],
                'attr' => [
                    'class' => 'form-select-lg',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Target::class,
        ]);
    }
}
