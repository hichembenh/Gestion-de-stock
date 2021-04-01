<?php

namespace App\Form;

use App\Entity\CommandeGros;
use App\Entity\CommandeUnitaire;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeGrosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref',TextType::class)
            ->add('montantTotal',IntegerType::class)
            ->add('mondat',IntegerType::class)
            ->add('restePayer',IntegerType::class)
            ->add('nomProp',TextType::class)
            ->add('numTel',TelType::class)
            ->add('adresse',TextType::class)
            ->add('etat',ChoiceType::class,[
            'choices'=> $this->getChoices(),
            'required' => false
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeGros::class,
        ]);
    }
    private function getChoices()
    {
        $choices = CommandeGros::ETAT;
        $output=[];
        foreach($choices as $k => $v){
            $output[$v]=$k;
        }
        return $output;
    }
}
