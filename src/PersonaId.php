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

namespace FSM\Symfony\Idpersona;

use FSM\Symfony\Idpersona\Enum\Identity;
use Symfony\Component\Validator\Constraints as Assert;

final class PersonaId
{
    private ?Identity $type = null;

    #[Assert\Length(max: 15)]
    private ?string $number = null;

    public function __construct(?string $id = null)
    {
        if ($id) {
            $this->setType(Identity::from((int) $id[0]));
            $this->setNumber(substr($id, 1));
        } else {
            $this->setType(Identity::NIF);
        }
    }

    public function __toString(): string
    {
        return $this->type->value . $this->number;
    }

    public function getType(): ?Identity
    {
        return $this->type;
    }

    public function setType(?Identity $type): void
    {
        $this->type = $type;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): void
    {
        $this->number = mb_strtoupper($number);
    }
}
