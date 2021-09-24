<?php

declare(strict_types=1);

namespace jbisbal\specification;

/**
 * @template Type
 * @extends Specification<Type>
 */
final class XorSpecification extends BinarySpecification
{
    /**
     * {@inheritdoc}
     */
    public function isSatisfiedBy($object): bool
    {
        return ($this->one()->isSatisfiedBy($object) xor $this->other()->isSatisfiedBy($object));
    }
}
