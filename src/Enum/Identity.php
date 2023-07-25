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

namespace FSM\Symfony\Idpersona\Enum;

enum Identity: int
{
    case NIF = 1;

    case PASSPORT = 2;

    case OTHER = 3;

    public static function choices(self $type): string
    {
        return match ($type) {
            self::NIF => 'N.I.F.',
            self::PASSPORT => 'Passport',
            self::OTHER => 'Other',
        };
    }
}
