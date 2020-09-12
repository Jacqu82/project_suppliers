<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @author Jacek Wesołowski <jacqu25@yahoo.com>
 */
class ContainsAlphanumeric extends Constraint
{
    public $message = 'Podana wartość  "{{ string }}" zawiera nielegalny znak(i)';
}
