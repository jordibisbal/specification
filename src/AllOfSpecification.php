<?php

declare(strict_types=1);

namespace jbisbal\specification;

use function Functional\every;

/**
 * @template Type
 * @extends Specification<Type>
 */
final class AllOfSpecification extends CompositeSpecification
{
    /** {@inheritdoc} */
    public function isSatisfiedBy($object): bool
    {
        return every($this->specifications, $this->isSatisfiedByFn($object));
    }
}
