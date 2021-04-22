<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter\Specifications;

use FlexFqcnFinder\Filter\Specifications\AlwaysFalse;
use FlexFqcnFinder\Test\TestCase;

class AlwaysFalseTest extends TestCase
{
    public function testAlwaysTrue()
    {
        $filter = new AlwaysFalse();
        $result = $filter->isSatisfiedBy('any');
        $this->assertFalse($result);
    }
}
