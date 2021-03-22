<?php

namespace App\Form;

use App\Entity\CommandeUnitaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CommandeUnitaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref',TextType::class)
            ->add('prix',NumberType::class)
            ->add('adresse',TextareaType::class)
            ->add('numTel',TelType::class)
            ->add('nomClient',TextType::class)
            ->add('numColis',IntegerType::class,[
                'required' => false
            ])
            ->add('etat',ChoiceType::class,[
                'choices'=> $this->getChoices(),
                'required' => false
            ])
        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $product = $event->getData();
            $form = $event->getForm();

            // checks if the Product object is "new"
            // If no data is passed to the form, the data is "null".
            // This should be considered a new "Product"
            if (!$product || null === $product->getId()) {
                $form->add('ref',TextType::class)
                    ->add('prix',NumberType::class)
                    ->add('adresse',TextareaType::class)
                    ->add('numTel',TelType::class)
                    ->add('nomClient',TextType::class);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeUnitaire::class,
        ]);
    }

    private function getChoices()
    {
        $choices = CommandeUnitaire::ETAT;
        $output=[];
        foreach($choices as $k => $v){
            $output[$v]=$k;
        }
        return $output;
    }
}
