<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter;

use FlexFqcnFinder\Filter\Chainable;
use FlexFqcnFinder\Filter\Filter;
use FlexFqcnFinder\Filter\FqcnSpecificationChain;
use FlexFqcnFinder\Test\TestCase;

class FilterTest extends TestCase
{
    public function testCreateFilterBy()
    {
        $by = Filter::by();
        $this->assertInstanceOf(FqcnSpecificationChain::class, $by);
    }

    public function testFilterBy()
    {
        $by = Filter::by();
        $by->alwaysTrue()->alwaysFalse();
        $this->assertFalse($by->isSatisfiedBy('any'));
    }

    public function testCreateFilterAnyOf()
    {
        $anyOf = Filter::by();
        $this->assertInstanceOf(FqcnSpecificationChain::class, $anyOf);
    }

    public function testFilterAnyOf()
    {
        $by = Filter::anyOf();
        $by->alwaysTrue()->alwaysFalse();
        $this->assertTrue($by->isSatisfiedBy('any'));
    }
}
