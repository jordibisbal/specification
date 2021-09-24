<?php

declare(strict_types=1);

namespace jbisbal\specification;

/**
 * @template Type
 * @extends Specification<Type>
 */
final class OrSpecification extends BinarySpecification
{
    /**
     * {@inheritdoc}
     */
    public function isSatisfiedBy($object): bool
    {
        return $this->one()->isSatisfiedBy($object) || $this->other()->isSatisfiedBy($object);
    }
}
