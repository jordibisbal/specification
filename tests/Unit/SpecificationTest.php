<?php

declare(strict_types=1);

namespace jbisbal\specification\Test\Unit;

use jbisbal\specification\Test\Unit\Stubs\BoolSpecification;
use PHPUnit\Framework\TestCase;

final class SpecificationTest extends TestCase
{
    public function testSpecification()
    {
        $trueSpec = new BoolSpecification(true);
        $falseSpec = new BoolSpecification(false);

        $this->assertTrue($trueSpec->isSatisfiedBy((object) []));
        $this->assertFalse($falseSpec->isSatisfiedBy((object) []));
    }

    public function testNotSpecification()
    {
        $trueSpec = new BoolSpecification(true);
        $falseSpec = new BoolSpecification(false);

        $notTrueSpec = $trueSpec->not();
        $notFalseSpec = $falseSpec->not();

        $this->assertSame($trueSpec, $notTrueSpec->specification());
        $this->assertFalse($notTrueSpec->isSatisfiedBy((object) []));
        $this->assertTrue($notFalseSpec->isSatisfiedBy((object) []));
    }

    public function testAndSpecification()
    {
        $trueSpec = new BoolSpecification(true);
        $falseSpec = new BoolSpecification(false);

        $trueAndTrueSpec = $trueSpec->and($trueSpec);
        $trueAndFalseSpec = $trueSpec->and($falseSpec);

        $this->assertSame($trueSpec, $trueAndFalseSpec->one());
        $this->assertSame($falseSpec, $trueAndFalseSpec->other());

        $this->assertTrue($trueAndTrueSpec->isSatisfiedBy((object) []));
        $this->assertFalse($trueAndFalseSpec->isSatisfiedBy((object) []));
    }

    public function testOrSpecification()
    {
        $trueSpec = new BoolSpecification(true);
        $falseSpec = new BoolSpecification(false);

        $trueOrTrueSpec = $trueSpec->or($trueSpec);
        $trueOrFalseSpec = $trueSpec->or($falseSpec);

        $this->assertSame($trueSpec, $trueOrFalseSpec->one());
        $this->assertSame($falseSpec, $trueOrFalseSpec->other());
        $this->assertTrue($trueOrTrueSpec->isSatisfiedBy((object) []));
        $this->assertTrue($trueOrFalseSpec->isSatisfiedBy((object) []));
    }

    public function testXorSpecification()
    {
        $trueSpec = new BoolSpecification(true);
        $falseSpec = new BoolSpecification(false);

        $trueXorTrueSpec = $trueSpec->xor($trueSpec);
        $trueXorFalseSpec = $trueSpec->xor($falseSpec);
        $falseXorTrueSpec = $falseSpec->xor($trueSpec);
        $falseXorFalseSpec = $falseSpec->xor($falseSpec);

        $this->assertSame($trueSpec, $trueXorFalseSpec->one());
        $this->assertSame($falseSpec, $trueXorFalseSpec->other());
        $this->assertFalse($trueXorTrueSpec->isSatisfiedBy((object) []));
        $this->assertTrue($trueXorFalseSpec->isSatisfiedBy((object) []));
        $this->assertTrue($falseXorTrueSpec->isSatisfiedBy((object) []));
        $this->assertFalse($falseXorFalseSpec->isSatisfiedBy((object) []));
    }

//    public function testAnyOfSpecification()
//    {
//        $trueSpec = new BoolSpecification(true);
//        $falseSpec = new BoolSpecification(false);
//        $this->assertTrue((new AnyOfSpecification($trueSpec, $trueSpec, $trueSpec))->isSatisfiedBy(new stdClass));
//        $this->assertFalse((new AnyOfSpecification($trueSpec, $trueSpec, $falseSpec))->isSatisfiedBy(new stdClass));
//    }
//
//    public function testOneOfSpecification()
//    {
//        $trueSpec = new BoolSpecification(true);
//        $falseSpec = new BoolSpecification(false);
//        $this->assertFalse((new OneOfSpecification($falseSpec, $falseSpec, $falseSpec))->isSatisfiedBy(new stdClass));
//        $this->assertTrue((new OneOfSpecification($falseSpec, $falseSpec, $trueSpec))->isSatisfiedBy(new stdClass));
//    }
//
//    public function testNoneOfSpecification()
//    {
//        $trueSpec = new BoolSpecification(true);
//        $falseSpec = new BoolSpecification(false);
//        $this->assertTrue((new NoneOfSpecification($falseSpec, $falseSpec, $falseSpec))->isSatisfiedBy(new stdClass));
//        $this->assertFalse((new NoneOfSpecification($falseSpec, $falseSpec, $trueSpec))->isSatisfiedBy(new stdClass));
//    }
//
//    public function testCriteriaComposition()
//    {
//        $trueSpec = new BoolSpecification(true);
//        $falseSpec = new BoolSpecification(false);
//        $compositeSpec =
//            new AnyOfSpecification(
//                $trueSpec->and($falseSpec)->or($trueSpec)->and($falseSpec),
//                new OneOfSpecification($trueSpec, $falseSpec, $trueSpec),
//                $trueSpec
//            );
//        $this->assertSame(
//            '((((1) AND (0)) OR (1)) AND (0)) AND ((1) OR (0) OR (1)) AND (1)',
//            $compositeSpec->whereExpression('a')
//        );
//    }
//
//    /**
//     * @expectedException \BadMethodCallException
//     */
//    public function testWhereExpressionIsNotSupported()
//    {
//        (new BoolSpecification(true))->not()->whereExpression('a');
//    }
}
