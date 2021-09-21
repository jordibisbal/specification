<?php

declare(strict_types=1);

namespace jbisbal\specification\Test\Unit\Stubs;

use jbisbal\specification\Specification;

/**
 * @extends Specification<bool>
 */
class BoolSpecification extends Specification
{
    private $bool;

    public function __construct(bool $bool)
    {
        $this->bool = $bool;
    }

    public function isSatisfiedBy($object): bool
    {
        return $this->bool;
    }
}
