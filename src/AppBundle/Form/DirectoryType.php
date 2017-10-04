<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DirectoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('apellidos', TextType::class, [
                    'attr' => [ 'class' => ''],
                    'label' => 'Apellidos',
                    'required' => 'required',
                ])
                ->add('nombre', TextType::class, [
                    'attr' => [ 'class' => ''],
                    'label' => 'Nombre',
                    'required' => 'required',
                ])
                ->add('edad', IntegerType::class, [
                    'attr' => [ 'class' => ''],
                    'label' => 'Edad',
                    'required' => 'required',
                ])	
                ->add('direccion', TextareaType::class, [ 
                    'required' => false,
                    'label' => 'Dirección',
                    'attr' => [ 'class' => '', 'rows' => 6]
                ])
                ->add('telefono', IntegerType::class, [
                    'attr' => [ 'class' => ''],
                    'label' => 'Teléfono',
                    'required' => 'required',
                ])				

                ->add('save', SubmitType::class, [ 
                    'attr' => [ 'class' => 'button tiny'],
					'label' => 'Guardar',
                ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Directory'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_directory';
    }


}
