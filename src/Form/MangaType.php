<?php

namespace App\Form;

use App\Entity\Etats;
use App\Entity\Genre;
use App\Entity\Manga;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MangaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $now = new \DateTime();
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'oeuvre',
                'help'  => "Si le titre commence par un chiffre, mettre un \"#\" devant le titre."
            ])
            ->add('year', IntegerType::class, [
                'label' => "Année de sortie de l'oeuvre",
                'help'  => "L'année de sortie comprise entre 1988 et ".$now->format('Y').""
            ])
            ->add('auteur', TextType::class, [
                'label' => "Auteur(s) de l'oeuvre",
                'help'  => "Si il y a plus d'un auteur, séparé chaque auteur par des ','."
            ])
            ->add('chapTotale', IntegerType::class, [
                'label' => "Chapitre acuel de l'oeuvre"
            ])
            ->add('synopsie', TextareaType::class, [
                'label' => "Résumé de l'oeuvre",
                'attr' => ['rows' => 10, 'cols' => 30]
            ])
            ->add('lel', UrlType::class, [
                'label' => "Lecture en ligne de l'oeuvre",
                'help'  => "Commence toujours par http://...."
            ])
            ->add('genres', EntityType::class, [
                'class'        => Genre::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded'     => true,
                'label'        => "Genre de l'oeuvre"
            ])
            ->add('type', EntityType::class, [
                'class'        => Type::class,
                'choice_label' => 'name',
                'multiple'     => false,
                'expanded'     => false,
                'label'        => "Type de l'oeuvre"
            ])
            ->add('etatsParution', EntityType::class, [
                'class'        => Etats::class,
                'choice_label' => 'name',
                'multiple'     => false,
                'expanded'     => false,
                'label'        => "Etats de parution de l'oeuvre"
            ])
            ->add('cover', ImageType::class,[
                'label' => 'Image de couvertur :',
                'attr' => []
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Manga::class,
        ]);
    }
}
