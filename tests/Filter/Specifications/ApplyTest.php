<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\Apply;
use FlexFqcnFinder\Test\TestCase;

class ApplyTest extends TestCase
{
    public function testApply()
    {
        $filter = new Apply(function (string $fqcn) {
            return $fqcn === 'ClassA';
        });

        $result1 = $filter->isSatisfiedBy('ClassA');
        $result2 = $filter->isSatisfiedBy('ClassB');
        $this->assertTrue($result1);
        $this->assertFalse($result2);
    }
}
