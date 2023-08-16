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

namespace FSM\Symfony\Idpersona\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
final class ValidPersonaId extends Constraint
{
    public string $message = 'This value is not valid.';

    // If the constraint has configuration options, define them as public properties
    public string $mode = 'strict';
}
