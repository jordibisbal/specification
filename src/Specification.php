<?php

declare(strict_types=1);

namespace jbisbal\specification;

use Closure;
use jbisbal\specification\Contracts\ExpressionBuilder;
use jbisbal\specification\Exceptions\UnableToBuildExpression;

use function Functional\partial_right;

/** @template Type */
abstract class Specification
{
    /** @param Type $object */
    abstract public function isSatisfiedBy($object): bool;

    /**
     * @param Specification<Type> $specification
     * @return AndSpecification<Type>
     */
    public function and(Specification $specification): AndSpecification
    {
        return new AndSpecification($this, $specification);
    }

    /**
     * @param Specification<Type> $specification
     * @return OrSpecification<Type>
     * @SuppressWarnings(PHPMD.ShortMethodName)
     */
    public function or(Specification $specification): OrSpecification
    {
        return new OrSpecification($this, $specification);
    }

    /**
     * @param Specification<Type> $specification
     * @return XorSpecification<Type>
     */
    public function xor(Specification $specification): XorSpecification
    {
        return new XorSpecification($this, $specification);
    }

    /** @return NotSpecification<Type> */
    public function not(): NotSpecification
    {
        return new NotSpecification($this);
    }

    /** @param Type $object */
    protected function isSatisfiedByFn($object): Closure
    {
        return partial_right(
            function (Specification $specification, $object) {
                return $specification->isSatisfiedBy($object);
            },
            $object
        );
    }

    /**
     * @template BuilderType
     * @param Type $object
     * @param ExpressionBuilder<BuilderType> $expressionBuilder
     * @return mixed
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function asExpression($object, ExpressionBuilder $expressionBuilder)
    {
        throw UnableToBuildExpression::becauseTheSpecificationHasNotImplementedAnyExpression();
    }
}
