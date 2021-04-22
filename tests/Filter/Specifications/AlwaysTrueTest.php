<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\AlwaysTrue;
use FlexFqcnFinder\Test\TestCase;

class AlwaysTrueTest extends TestCase
{
    public function testAlwaysTrue()
    {
        $filter = new AlwaysTrue();
        $result = $filter->isSatisfiedBy('any');
        $this->assertTrue($result);
    }
}
