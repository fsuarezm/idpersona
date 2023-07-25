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

namespace FSM\Symfony\Idpersona\DependencyInjection;

use FSM\Symfony\Idpersona\Form\PersonaIdType;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;

class IdpersonaExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container
            ->setDefinition('form.personaid', new Definition(PersonaIdType::class))
            ->addTag('form.type')
            ->setPublic(false)
        ;
    }
}