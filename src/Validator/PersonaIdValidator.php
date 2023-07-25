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

USE FSM\Symfony\Idpersona\PersonaId as IdPersona;
use FSM\Symfony\Idpersona\Enum\Identity;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class PersonaIdValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        if (! $constraint instanceof PersonaId) {
            throw new UnexpectedTypeException($constraint, PersonaId::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (! $value instanceof IdPersona) {
            throw new UnexpectedTypeException($constraint, IdPersona::class);
        }

        $type = $value->getType();
        $number = $value->getNumber();

        if ($type === null && $number === null) {
            return;
        }

        if ($type === null || $number === null) {
            $this->context->buildViolation($constraint->message)
                ->atPath('number')
                ->addViolation();

            return;
        }

        if ($type === Identity::NIF) {
            if ($value->getNumber() === null || ! $this->validNif($value->getNumber())) {
                $this->context->buildViolation($constraint->message)
                    ->atPath('number')
                    ->addViolation();
            }
        }
    }

    private function calculateModulus($dni): int
    {
        $numeric = substr($dni, 0, -1);
        $number = (int) str_replace(['X', 'Y', 'Z'], ['0', '1', '2'], $numeric);

        return $number % 23;
    }

    private function validNif(string $dni): bool
    {
        if (! preg_match('/^[XYZ\d]\d{7,7}[^UIOÑ\d]$/u', $dni)) {
            return false;
        }

        $mod = $this->calculateModulus($dni);
        $letter = substr($dni, -1);

        return $letter === 'TRWAGMYFPDXBNJZSQVHLCKE'[$mod];
    }
}
