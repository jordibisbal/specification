<?php
declare(strict_types=1);

namespace jbisbal\specification\Contracts;

/**
 * @template ValueType
 * @template ReturnType
 */
interface ExpressionBuilder
{
    /**
     * @param ValueType $value
     * @return ReturnType
     */
    public function resolve($value);
}
