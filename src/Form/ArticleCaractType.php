<?php

namespace App\Form;

use App\Entity\ArticleCaract;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleCaractType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('taille',ChoiceType::class,[
                'choices'=>$this->getChoices(),
                'required'=>true
            ])
            ->add('quantite',IntegerType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleCaract::class,
        ]);
    }
    private function getChoices()
    {
        $choices = ArticleCaract::Tailles;
        $output=[];
        foreach($choices as $k => $v){
            $output[$v]=$k;
        }
        return $output;
    }
}
