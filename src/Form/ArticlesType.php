<?php

namespace App\Form;

use App\Entity\ArticleCaract;
use App\Entity\ArticlesFini;
use App\Entity\CommandeGros;
use App\Repository\ArticleCaractRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref', TextType::class)
            ->add('description', TextareaType::class)
            ->add('quantite', IntegerType::class)
            ->add('etat',ChoiceType::class,[
                'choices'=> $this->getChoices(),
                'required' => false,
                'label'=>'mawjoud ?'
            ])
            ->add('image', FileType::class,[
                'label' => "Image de l'article",
                'mapped'=> false,
                // unmapped means that this field is not associated to any entity property
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => "l'image doit etre de la format jpeg ou png ou webp",
                    ])
                ],
            ])
            ->add('articleCaracts',EntityType::class,[
                'class'=>ArticleCaract::class,
                'choices'=>$this->getChoicesTailles(),
                'placeholder' => 'Sélectionnez la taille',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticlesFini::class,
        ]);
    }
    private function getChoices()
    {
        $choices = ArticlesFini::ETAT;
        $output=[];
        foreach($choices as $k => $v){
            $output[$v]=$k;
        }
        return $output;
    }
    private function getChoicesTailles()
    {
        $choices = ArticleCaract::Tailles;
        $output=[];
        foreach($choices as $k => $v){
            $output[$v]=$k;
        }
        return $output;
    }
}
