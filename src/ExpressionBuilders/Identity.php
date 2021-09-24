<?php
declare(strict_types=1);

namespace jbisbal\specification\ExpressionBuilders;

use jbisbal\specification\Contracts\ExpressionBuilder;

/**
 * @implements ExpressionBuilder<mixed, mixed>
 */
final class Identity implements ExpressionBuilder
{
    private function __construct()
    {
    }

    public static function create(): Identity
    {
        return new self();
    }

    /**
     * @template Type
     * @param Type $value
     * @return Type
     */
    public function resolve($value)
    {
        return $value;
    }
}
