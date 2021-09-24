<?php

declare(strict_types=1);

namespace jbisbal\specification;

/**
 * @template Type
 * @extends Specification<Type>
 */
abstract class BinarySpecification extends CompositeSpecification
{
    /**
     * @param Specification<Type> $one
     * @param Specification<Type> $other
     */
    public function __construct(Specification $one, Specification $other)
    {
        parent::__construct($one, $other);
    }

    /**
     * @return Specification<Type>
     */
    public function one(): Specification
    {
        return $this->specifications()[0];
    }

    /**
     * @return Specification<Type>
     */
    public function other(): Specification
    {
        return $this->specifications()[1];
    }
}
