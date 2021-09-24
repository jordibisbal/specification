<?php

declare(strict_types=1);

namespace jbisbal\specification\Test\Unit\Stubs;

use Closure;
use jbisbal\specification\Contracts\ExpressionBuilder;
use jbisbal\specification\Specification;
use function Functional\partial_right;

/**
 * @template Type
 * @extends Specification<bool>
 */
class IdentitySpecification extends Specification
{
    private function __construct()
    {
    }

    public static function create(): IdentitySpecification
    {
        return new self();
    }

    /** @inheritDoc */
    public function isSatisfiedBy($object): bool
    {
        return true;
    }

    /** @return Type */
    public function asExpression($object, ExpressionBuilder $expressionBuilder)
    {
        return $expressionBuilder->resolve($object);
    }

    /** @noinspection PhpParamsInspection */
    public function expressionBuilder(ExpressionBuilder $expressionBuilder): Closure
    {
        return partial_right([$this, 'asExpression'], $expressionBuilder);
    }
}
