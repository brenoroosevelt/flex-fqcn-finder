<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test;

use FlexFqcnFinder\FqcnFinderComposite;
use FlexFqcnFinder\Test\Stubs\FixedArrayFqcnFinder;

class FqcnFinderCompositeTest extends TestCase
{
    public function testComposite()
    {
        $finder1 = new FixedArrayFqcnFinder(['Class1', 'Class2', 'Class3']);
        $finder2 = new FixedArrayFqcnFinder(['Class2', 'Class4', 'Class5']);

        $composite = new FqcnFinderComposite($finder1, $finder2);
        $this->assertEquals(['Class1', 'Class2', 'Class3', 'Class4', 'Class5'], array_values($composite->find()));
    }
}
