<?php
declare(strict_types=1);

namespace jbisbal\specification\Exceptions;

use RuntimeException;

final class UnableToBuildExpression extends RuntimeException
{
    public static function becauseTheSpecificationHasNotImplementedAnyExpression(): UnableToBuildExpression
    {
        return new self('Because the specification has not implemented expression()');
    }
}
