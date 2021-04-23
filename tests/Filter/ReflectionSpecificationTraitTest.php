<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter;

use FlexFqcnFinder\Filter\ReflectionSpecificationTrait;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\TestCase;
use ReflectionClass;

class ReflectionSpecificationTraitTest extends TestCase
{
    public function testReflectionError()
    {
        $trait = new class {
            use ReflectionSpecificationTrait;

            protected function isSatisfiedByReflection(string $fqcn, ReflectionClass $reflectionClass): bool
            {
                return true;
            }
        };

        $result = $trait->isSatisfiedBy('InvalidClass');
        $this->assertFalse($result);
    }

    public function testReflectionSuccess()
    {
        $trait = new class {
            use ReflectionSpecificationTrait;

            protected function isSatisfiedByReflection(string $fqcn, ReflectionClass $reflectionClass): bool
            {
                return true;
            }
        };

        $result = $trait->isSatisfiedBy(ClassA::class);
        $this->assertTrue($result);
    }
}
