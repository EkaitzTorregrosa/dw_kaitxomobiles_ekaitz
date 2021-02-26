<?php

namespace App\Form;

use App\Entity\Mobiles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MobilesType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('name', TextType::class, [
                    'label' => 'Name: ',
                    'attr' => ['class' => 'form-control  '],
                ])
                ->add('description', TextType::class, [
                    'label' => 'Descripción: ',
                    'attr' => ['class' => 'form-control  '],
                ])
                ->add('urlPicture', TextType::class, [
                    'label' => 'Imágen: ',
                    'attr' => ['class' => 'form-control  '],
                ])
                ->add('price', TextType::class, [
                    'label' => 'Precio: ',
                    'attr' => ['class' => 'form-control  '],
                ])
                ->add('save', SubmitType::class, array('label' => 'Continue', 'attr' => array('class' => 'btn btn-primary')))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Mobiles::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'App_mobiles';
    }

}
