<?php

declare(strict_types=1);

namespace jbisbal\specification;

/**
 * @template T
 * @extends Specification<T>
 */
final class AndSpecification extends Specification
{
    /** @var Specification<T> */
    private $one;

    /** @var Specification<T> */
    private $other;

    /**
     * @param Specification<T> $one
     * @param Specification<T> $other
     */
    public function __construct(Specification $one, Specification $other)
    {
        $this->one   = $one;
        $this->other = $other;
    }

    /**
     * {@inheritdoc}
     */
    public function isSatisfiedBy($object): bool
    {
        return $this->one->isSatisfiedBy($object) && $this->other->isSatisfiedBy($object);
    }

    /**
     * @return Specification<T>
     */
    public function one(): Specification
    {
        return $this->one;
    }

    /**
     * @return Specification<T>
     */
    public function other(): Specification
    {
        return $this->other;
    }
}
