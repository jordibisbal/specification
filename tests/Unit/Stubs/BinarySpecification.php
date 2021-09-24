<?php
declare(strict_types=1);

namespace jbisbal\specification\Test\Unit\Stubs;


use jbisbal\specification\BinarySpecification as AbstractBinarySpecification;

final class BinarySpecification extends AbstractBinarySpecification
{

    /** @inheritDoc */
    public function isSatisfiedBy($object): bool
    {
        return true;
    }
}
