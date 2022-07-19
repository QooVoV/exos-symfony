<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'=> "Titre du livre : ", 
                'required'=> true
            ])
            ->add('price', MoneyType::class, [
                'label'=> "Prix à l'unité : ",
                'required'=> true
            ])
            ->add('description', TextareaType::class, [
                'label'=> "Synopsis du livre : ",
                'required'=> false
            ])
            ->add('imageUrl', UrlType::class, [
                'label'=> "Couverture(s) : ",
                'required'=> false
            ])
            ->add('send', SubmitType::class, [
                'label'=> "Valider"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
