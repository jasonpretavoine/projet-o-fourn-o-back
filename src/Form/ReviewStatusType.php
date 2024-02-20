<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class ReviewStatusType extends AbstractType
{
    private CsrfTokenManagerInterface $csrfTokenManager;

    public function __construct(CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', null, [
                'disabled' => true, // Pour afficher le commentaire mais le rendre non modifiable
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Approuvé' => '1',
                    'Rejeté' => '0',
                ],
            ])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return ''; // Doit retourner une chaîne vide pour éviter la surcharge du nom du formulaire dans le nom du champ CSRF
    }

    public function getCsrfToken(): string
    {
        return $this->csrfTokenManager->getToken('review_status')->getValue();
    }
}
