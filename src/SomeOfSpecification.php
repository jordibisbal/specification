<?php

declare(strict_types=1);

namespace jbisbal\specification;

use function Functional\some;

/**
 * @template Type
 * @extends Specification<Type>
 */
final class SomeOfSpecification extends CompositeSpecification
{
    /**
     * {@inheritdoc}
     */
    public function isSatisfiedBy($object): bool
    {
        return some($this->specifications, $this->isSatisfiedByFn($object));
    }
}
