<?php

declare(strict_types=1);

namespace jbisbal\specification\Test\Unit;

use jbisbal\specification\AllOfSpecification;
use jbisbal\specification\Exceptions\UnableToBuildExpression;
use jbisbal\specification\ExpressionBuilders\Identity;
use jbisbal\specification\NoneOfSpecification;
use jbisbal\specification\SomeOfSpecification;
use jbisbal\specification\Test\Unit\Stubs\BinarySpecification;
use jbisbal\specification\Test\Unit\Stubs\BooleanSpecification;
use jbisbal\specification\Test\Unit\Stubs\IdentitySpecification;
use PHPUnit\Framework\TestCase;

final class SpecificationTest extends TestCase
{
    const A_VALUE = 'a value';

    public function testSpecification()
    {
        $trueSpecification = new BooleanSpecification(true);
        $falseSpecification = new BooleanSpecification(false);

        $this->assertTrue($trueSpecification->isSatisfiedBy((object) []));
        $this->assertFalse($falseSpecification->isSatisfiedBy((object) []));
    }

    public function testNotSpecification()
    {
        $trueSpecification = new BooleanSpecification(true);
        $falseSpecification = new BooleanSpecification(false);

        $notTrueSpec = $trueSpecification->not();
        $notFalseSpec = $falseSpecification->not();

        $this->assertSame($trueSpecification, $notTrueSpec->specification());
        $this->assertFalse($notTrueSpec->isSatisfiedBy((object) []));
        $this->assertTrue($notFalseSpec->isSatisfiedBy((object) []));
    }

    public function testAndSpecification()
    {
        $trueSpecification = new BooleanSpecification(true);
        $falseSpecification = new BooleanSpecification(false);

        $trueAndTrueSpec = $trueSpecification->and($trueSpecification);
        $trueAndFalseSpec = $trueSpecification->and($falseSpecification);

        $this->assertTrue($trueAndTrueSpec->isSatisfiedBy((object) []));
        $this->assertFalse($trueAndFalseSpec->isSatisfiedBy((object) []));
    }

    public function testOrSpecification()
    {
        $trueSpecification = new BooleanSpecification(true);
        $falseSpecification = new BooleanSpecification(false);

        $trueOrTrueSpec = $trueSpecification->or($trueSpecification);
        $trueOrFalseSpec = $trueSpecification->or($falseSpecification);

        $this->assertTrue($trueOrTrueSpec->isSatisfiedBy((object) []));
        $this->assertTrue($trueOrFalseSpec->isSatisfiedBy((object) []));
    }

    public function testXorSpecification()
    {
        $trueSpecification = new BooleanSpecification(true);
        $falseSpecification = new BooleanSpecification(false);

        $trueXorTrueSpec = $trueSpecification->xor($trueSpecification);
        $trueXorFalseSpec = $trueSpecification->xor($falseSpecification);
        $falseXorTrueSpec = $falseSpecification->xor($trueSpecification);
        $falseXorFalseSpec = $falseSpecification->xor($falseSpecification);

        $this->assertFalse($trueXorTrueSpec->isSatisfiedBy((object) []));
        $this->assertTrue($trueXorFalseSpec->isSatisfiedBy((object) []));
        $this->assertTrue($falseXorTrueSpec->isSatisfiedBy((object) []));
        $this->assertFalse($falseXorFalseSpec->isSatisfiedBy((object) []));
    }

    public function testAllOfSpecification()
    {
        $trueSpecification = new BooleanSpecification(true);
        $falseSpecification = new BooleanSpecification(false);

        $this->assertTrue(
            (new AllOfSpecification($trueSpecification, $trueSpecification, $trueSpecification))
                ->isSatisfiedBy((object) [])
        );
        $this->assertFalse(
            (new AllOfSpecification($trueSpecification, $trueSpecification, $falseSpecification))
                ->isSatisfiedBy((object) [])
        );
    }

    public function testSomeOfSpecification()
    {
        $trueSpecification = new BooleanSpecification(true);
        $falseSpecification = new BooleanSpecification(false);

        $this->assertFalse(
            (new SomeOfSpecification($falseSpecification, $falseSpecification, $falseSpecification))
                ->isSatisfiedBy((object) [])
        );
        $this->assertTrue(
            (new SomeOfSpecification($falseSpecification, $falseSpecification, $trueSpecification))
                ->isSatisfiedBy((object) [])
        );
    }

    public function testNoneOfSpecification()
    {
        $trueSpecification = new BooleanSpecification(true);
        $falseSpecification = new BooleanSpecification(false);
        $this->assertTrue(
            (new NoneOfSpecification($falseSpecification, $falseSpecification, $falseSpecification))
                ->isSatisfiedBy((object) [])
        );
        $this->assertFalse(
            (new NoneOfSpecification($falseSpecification, $falseSpecification, $trueSpecification))
                ->isSatisfiedBy((object) [])
        );
    }

    public function testBinarySpecification()
    {
        $trueSpecification = new BooleanSpecification(true);
        $falseSpecification = new BooleanSpecification(false);

        $specification = new BinarySpecification($trueSpecification, $falseSpecification);

        $this->assertSame($trueSpecification, $specification->one());
        $this->assertSame($falseSpecification, $specification->other());
        $this->assertSame([$trueSpecification, $falseSpecification], $specification->specifications());
    }

    public function testExceptionIsRaisedIfNoExpressionIsImplemented()
    {
        $trueSpecification = new BooleanSpecification(true);

        $this->expectException(UnableToBuildExpression::class);
        $this->expectExceptionMessage('Because the specification has not implemented expression()');

        $trueSpecification->asExpression(self::A_VALUE, Identity::create());
    }

    public function testCanBuildAnExpression()
    {
        $identitySpecification = IdentitySpecification::create();
        $identifyBuilder = Identity::create();

        self::assertEquals(
            self::A_VALUE,
            $identitySpecification->asExpression(self::A_VALUE, $identifyBuilder)
        );
    }
}
