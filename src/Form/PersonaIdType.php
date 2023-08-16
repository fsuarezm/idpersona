<?php

/*
 * This file is part of fsuarezm/idpersona
 *
 * (c) Francisco Suárez Mulero
 * @author: Francisco Suárez Mulero
 * @email: fsuarezm@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FSM\Symfony\Idpersona\Form;

use FSM\Symfony\Idpersona\Enum\Identity;
use FSM\Symfony\Idpersona\PersonaId;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaIdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $required = $options['disabled'] ? false : $options['required'];

        $builder
            ->add('type', EnumType::class, [
                'label' => 'type_doc',
                'class' => Identity::class,
                'choice_label' => fn ($choice) => Identity::choices($choice),
                'placeholder' => 'select',
                'required' => $required,
            ])
            ->add('number', null, [
                'label' => 'document',
                'required' => $required,
                'attr' => [
                    'class' => 'text-uppercase',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonaId::class,
        ]);
    }
}
