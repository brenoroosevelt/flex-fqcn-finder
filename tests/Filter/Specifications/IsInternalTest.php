<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\IsInternal;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\TestCase;
use stdClass;

class IsInternalTest extends TestCase
{
    public function testClassIsInternal()
    {
        $filter = new IsInternal();
        $result = $filter->isSatisfiedBy(ClassA::class);
        $this->assertFalse($result);
    }

    public function testStdClassIsInterface()
    {
        $filter = new IsInternal();
        $result = $filter->isSatisfiedBy(stdClass::class);
        $this->assertTrue($result);
    }
}
