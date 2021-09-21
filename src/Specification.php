<?php

declare(strict_types=1);

namespace jbisbal\specification;

/** @template T */
abstract class Specification
{
    /** @param T $object */
    abstract public function isSatisfiedBy($object): bool;

    /**
     * @param Specification<T> $specification
     * @return AndSpecification<T>
     */
    public function and(Specification $specification): AndSpecification
    {
        return new AndSpecification($this, $specification);
    }

    /**
     * @param Specification<T> $specification
     * @return OrSpecification<T>
     * @SuppressWarnings(PHPMD.ShortMethodName)
     */
    public function or(Specification $specification): OrSpecification
    {
        return new OrSpecification($this, $specification);
    }

    /**
     * @param Specification<T> $specification
     * @return XorSpecification<T>
     */
    public function xor(Specification $specification): XorSpecification
    {
        return new XorSpecification($this, $specification);
    }

    /**
     * @return NotSpecification<T>
     */
    public function not(): NotSpecification
    {
        return new NotSpecification($this);
    }
}
