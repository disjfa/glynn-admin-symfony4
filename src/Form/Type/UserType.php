<?php

namespace App\Form\Type;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;
use Symfony\Component\Translation\TranslatorInterface;

class UserType extends AbstractType
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, [
            'label' => 'user.label.username',
        ]);

        $builder->add('email', EmailType::class, [
            'label' => 'user.label.email',
        ]);

        $builder->add('roles', ChoiceType::class, [
            'choices' => [
                'user.choice.role_user' => 'ROLE_USER',
                'user.choice.role_admin' => 'ROLE_ADMIN',
            ],
            'label' => 'user.label.roles',
            'multiple' => true,
            'expanded' => true,
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'admin',
            'constraints' => [
                new UniqueEntity([
                    'fields' => ['username'],
                ]),
                new UniqueEntity([
                    'fields' => ['email'],
                ]),
            ],
        ]);
    }
}
