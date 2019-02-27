<?php

namespace App\Form;

use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\Formation;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('sousTitre')
            ->add('descriptionCourte')
            ->add('descriptionLongue')
            ->add('email')
            /*->add('formations',EntityType::class,['class' => Formation::class,
                                                  'choice_label' => 'nomCourt',
                                                  'multiple' => true,
                                                  'expanded' => true])
            //->add('entreprise', EntrepriseType::class)
            ->add('entreprise',EntityType::class,['class' => Entreprise::class,
                                                  'choice_label' => 'nom',
                                                  'multiple' => false,
                                                  'expanded' => true])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
