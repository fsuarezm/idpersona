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

namespace FSM\Symfony\Idpersona\Doctrine\DBAL\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use FSM\Symfony\Idpersona\PersonaId;

final class PersonaIdType extends StringType
{
    /**
     * @param mixed            $value    The value to convert.
     * @param AbstractPlatform $platform The currently used database platform.
     *
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return $value;
        }

        /** @var PersonaId $value */
        return (string) $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?PersonaId
    {
        if ($value) {
            return new PersonaId($value);
        }

        return null;
    }

    public function getName(): string
    {
        return 'persona_id';
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        $column['length'] = 16;
        $column['fixed'] = false;

        return $platform->getStringTypeDeclarationSQL($column);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
