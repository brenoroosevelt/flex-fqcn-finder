<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsUserDefined;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\TestCase;
use stdClass;

class IsUserDefinedTest extends TestCase
{
    public function testClassIsUserDefined()
    {
        $filter = new IsUserDefined();
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }

    public function testInternalClassIsUserDefined()
    {
        $filter = new IsUserDefined();
        $result = $filter->isSatisfiedBy(stdClass::class);
        $this->assertFalse($result);
    }
}
