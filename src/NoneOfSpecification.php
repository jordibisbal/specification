<?php

declare(strict_types=1);

namespace jbisbal\specification;

use function Functional\none;

/**
 * @template Type
 * @extends Specification<Type>
 */
final class NoneOfSpecification extends CompositeSpecification
{
    /** {@inheritdoc} */
    public function isSatisfiedBy($object): bool
    {
        return none($this->specifications, $this->isSatisfiedByFn($object));
    }
}
