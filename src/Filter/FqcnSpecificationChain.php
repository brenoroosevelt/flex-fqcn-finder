<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Filter;

use Closure;

/**
 * @method self apply(Closure $fn)
 * @method self belongsToNamespace(string $namespace)
 * @method self classNameEndsWith(string $value)
 * @method self classNameStartsWith(string $value)
 * @method self hasMethod(string $method)
 * @method self implementsInterface(string $interface)
 * @method self isAbstract()
 * @method self isClass()
 * @method self isCloneable()
 * @method self isFinal()
 * @method self isInstanceOf(string $subject)
 * @method self isInstantiable()
 * @method self isInterface()
 * @method self isInternal()
 * @method self isIterateable()
 * @method self isSubClassOf(string $class)
 * @method self isTrait()
 * @method self isUserDefined()
 * @method self namespaceEqualsTo(string $namespace)
 * @method self not(FqcnSpecification $specification)
 * @method self useTrait(string $trait)
 * @method self anyOf(FqcnSpecification $specification, FqcnSpecification ...$specifications)
 * @method self allOf(FqcnSpecification $specification, FqcnSpecification ...$specifications)
 * @method self and(FqcnSpecification $specification, FqcnSpecification ...$specifications)
 * @method self or(FqcnSpecification $specification, FqcnSpecification ...$specifications)
 */
final class FqcnSpecificationChain implements FqcnSpecification
{
    /**
     * @var Chainable
     */
    private $chain;

    /**
     * @var FqcnSpecificationFactory
     */
    private $fqcnSpecificationFactory;

    public function __construct(Chainable $chain)
    {
        $this->chain = $chain;
        $this->fqcnSpecificationFactory = new FqcnSpecificationFactory();
    }

    public function isSatisfiedBy(string $fqcn): bool
    {
        return $this->chain->isSatisfiedBy($fqcn);
    }

    public function __call($name, $arguments)
    {
        $this->chain->append($this->fqcnSpecificationFactory->{$name}(...$arguments));
        return $this;
    }
}
