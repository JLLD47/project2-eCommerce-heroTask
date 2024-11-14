<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('difficulty', choiceType::class, [
                'choices' => [
                    'Easy' => '1',
                    'Medium' => '2',
                    'Hard' => '3',
                ],
                'multiple' => false
            ])
            ->add('recurrence', choiceType::class, ['choices' => ['choices' => ['Once' => 'Once', 'Daily' => 'Daily', 'weekly' => 'Weekly', 'Monthly' => 'Monthly']]])
            ->add('type', ChoiceType::class, ['choices' => [
                'Strength' => 'Strength',
                'Intelligence' => 'Intelligence',
                'Constitution' => 'Constitution',
                'Charisma' => 'Charisma',
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
