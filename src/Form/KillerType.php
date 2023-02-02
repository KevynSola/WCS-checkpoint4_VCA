<?php

namespace App\Form;

use App\Entity\Killer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class KillerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            /* ->add('avatarFile', VichImageType::class, [
                'required'      => false,
            ])  */
            ->add('avatar', UrlType::class, [
                'required'      => false,
            ]) 
            ->add('skills', ChoiceType::class, [
                'choices' => [
                    'Fist' => 'fist',
                    'Gun' => 'gun',
                    'Knife' => 'knife',
                    'Fiction' => 'fiction',
                    'Real' => 'real',
                    'Anime' => 'anime',
                    'Solo' => 'solo',
                    'Band' => 'band',
                    'Crazy' => 'crazy',
                    'Demon' => 'demon'
                ],
                'multiple' => true,
                'autocomplete' => true,
            ])
        ->add('biography', TextareaType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Killer::class,
        ]);
    }
}
