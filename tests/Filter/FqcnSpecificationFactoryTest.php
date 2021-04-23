<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Filter;

use FlexFqcnFinder\Filter\FqcnSpecificationFactory;
use FlexFqcnFinder\Filter\ReflectionSpecificationTrait;
use FlexFqcnFinder\Filter\Specifications\AllOf;
use FlexFqcnFinder\Filter\Specifications\AlwaysFalse;
use FlexFqcnFinder\Filter\Specifications\AlwaysTrue;
use FlexFqcnFinder\Filter\Specifications\AnyOf;
use FlexFqcnFinder\Filter\Specifications\Apply;
use FlexFqcnFinder\Filter\Specifications\BelongsToNamespace;
use FlexFqcnFinder\Filter\Specifications\ClassNameEndsWith;
use FlexFqcnFinder\Filter\Specifications\ClassNameStartsWith;
use FlexFqcnFinder\Filter\Specifications\HasMethod;
use FlexFqcnFinder\Filter\Specifications\ImplementsInterface;
use FlexFqcnFinder\Filter\Specifications\IsAbstract;
use FlexFqcnFinder\Filter\Specifications\IsClass;
use FlexFqcnFinder\Filter\Specifications\IsCloneable;
use FlexFqcnFinder\Filter\Specifications\IsFinal;
use FlexFqcnFinder\Filter\Specifications\IsInstanceOf;
use FlexFqcnFinder\Filter\Specifications\IsInstantiable;
use FlexFqcnFinder\Filter\Specifications\IsInterface;
use FlexFqcnFinder\Filter\Specifications\IsInternal;
use FlexFqcnFinder\Filter\Specifications\IsIterateable;
use FlexFqcnFinder\Filter\Specifications\IsSubClassOf;
use FlexFqcnFinder\Filter\Specifications\IsTrait;
use FlexFqcnFinder\Filter\Specifications\IsUserDefined;
use FlexFqcnFinder\Filter\Specifications\NamespaceEqualsTo;
use FlexFqcnFinder\Filter\Specifications\Not;
use FlexFqcnFinder\Filter\Specifications\UseTrait;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\TestCase;
use ReflectionClass;
use RuntimeException;

class FqcnSpecificationFactoryTest extends TestCase
{
    public function createSpecificationProvider()
    {
        // @codingStandardsIgnoreStart
        return [
            ['apply', [function(){}], Apply::class],
            ['alwaysTrue', [], AlwaysTrue::class],
            ['alwaysFalse', [], AlwaysFalse::class],
            ['belongsToNamespace', ['any'], BelongsToNamespace::class],
            ['classNameEndsWith', ['any'], ClassNameEndsWith::class],
            ['classNameStartsWith', ['any'], ClassNameStartsWith::class],
            ['hasMethod', ['any'], HasMethod::class],
            ['implementsInterface', ['any'], ImplementsInterface::class],
            ['isAbstract', [], IsAbstract::class],
            ['isClass', [], IsClass::class],
            ['isCloneable', [], IsCloneable::class],
            ['isFinal', [], IsFinal::class],
            ['isInstanceOf', ['any'], IsInstanceOf::class],
            ['isInstantiable', [], IsInstantiable::class],
            ['isInterface', [], IsInterface::class],
            ['isInternal', [], IsInternal::class],
            ['isIterateable', [], IsIterateable::class],
            ['isSubClassOf', ['any'], IsSubClassOf::class],
            ['isTrait', [], IsTrait::class],
            ['isUserDefined', [], IsUserDefined::class],
            ['namespaceEqualsTo', ['any'], NamespaceEqualsTo::class],
            ['not', [new AlwaysFalse], Not::class],
            ['useTrait', ['any'], UseTrait::class],
            ['anyOf', [new AlwaysFalse], AnyOf::class],
            ['allOf', [new AlwaysFalse], AllOf::class],
        ];
        // @codingStandardsIgnoreEnd
    }

    /**
     * @dataProvider createSpecificationProvider
     * @param $name
     * @param $args
     * @param $instanceOfClass
     */
    public function testCreateSpecification($name, $args, $instanceOfClass)
    {
        $factory = new FqcnSpecificationFactory();
        $instance = $factory->__call($name, $args);
        $this->assertInstanceOf($instanceOfClass, $instance);
    }

    public function testCreateInvalidSpecification()
    {
        $factory = new FqcnSpecificationFactory();
        $this->expectException(RuntimeException::class);
        $factory->__call('invalidSpecification', []);
    }

    public function testCreateAnd()
    {
        $factory = new FqcnSpecificationFactory();
        $instance = $factory->and(new AlwaysTrue());
        $this->assertInstanceOf(AllOf::class, $instance);
    }

    public function testCreateOr()
    {
        $factory = new FqcnSpecificationFactory();
        $instance = $factory->or(new AlwaysTrue());
        $this->assertInstanceOf(AnyOf::class, $instance);
    }
}
