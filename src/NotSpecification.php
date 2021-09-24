<?php

declare(strict_types=1);

namespace jbisbal\specification;

/**
 * @template Type
 * @extends Specification<Type>
 */
final class NotSpecification extends Specification
{
    /** @var Specification<Type> */
    private $specification;

    /**
     * @param Specification<Type> $specification
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
     * @return Specification<Type>
     */
    public function specification(): Specification
    {
        return $this->specification;
    }
}
