<?php

declare(strict_types=1);

namespace jbisbal\specification;

/**
 * @template Type
 * @extends Specification<Type>
 */
abstract class CompositeSpecification extends Specification
{
    /** @var array<Specification<Type>> */
    protected $specifications;

    /** @param  array<Specification<Type>> $specifications */
    public function __construct(...$specifications)
    {
        $this->specifications = $specifications;
    }

    /** @return array<Specification<Type>> */
    public function specifications(): array
    {
        return $this->specifications;
    }
}
