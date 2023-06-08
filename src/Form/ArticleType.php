<?php

namespace App\Form;

use App\Entity\Article;

use Cassandra\Date;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraint as Assert;
use Symfony\Component\Validator\Constraints\Length;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url',TextType::class,[
                'attr' => [
                    'class' =>'form-control'
                ],
                'label' =>"URL",
                'label_attr' => [
                    'class' =>'form-label mt-4'
                ]


            ])
            ->add('resume',TextType::class,[
        'attr' => [
            'class' =>'form-control'
        ],
        'label' =>"Résumé",
        'label_attr' => [
            'class' =>'form-label mt-4'
        ]


    ])
            ->add('titre',TextType::class,[
                'attr' => [
                    'class' =>'form-control'
                ],
                'label' =>"Titre",
                'label_attr' => [
                    'class' =>'form-label mt-4'
                ]
            ])
            ->add('dateenre',DateType::class,[
                'attr' =>[
                    'label'=>"Date de création",
                    'label_attr'=>'form-label mt-4'
                ]
            ])
            ->add('submit',SubmitType::class,[
                'attr'=>[
                    'class'=> 'btn btn-primary mt-4'
                ],
                'label'=>'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
