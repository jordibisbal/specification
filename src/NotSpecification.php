<?php

declare(strict_types=1);

namespace jbisbal\specification;

/**
 * @template T
 * @extends Specification<T>
 */
final class NotSpecification extends Specification
{
    /** @var Specification<T> */
    private $specification;

    /**
     * @param Specification<T> $specification
     */
    public function __construct(Specification $specification)
    {
        $this->specification   = $specification;
    }

    /**
     * {@inheritdoc}
     */
    public function isSatisfiedBy($object): bool
    {
        return !$this->specification->isSatisfiedBy($object);
    }

    /**
     * @return Specification<T>
     */
    public function specification(): Specification
    {
        return $this->specification;
    }
}
