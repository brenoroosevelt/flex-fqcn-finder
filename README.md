# Flex FQCN Finder
[![Build](https://github.com/brenoroosevelt/flex-fqcn-finder/actions/workflows/ci.yml/badge.svg)](https://github.com/brenoroosevelt/oni-bus/actions/workflows/ci.yml)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/brenoroosevelt/flex-fqcn-finder/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/brenoroosevelt/flex-fqcn-finder/?branch=main)
[![codecov](https://codecov.io/gh/brenoroosevelt/flex-fqcn-finder/branch/main/graph/badge.svg?token=S1QBA18IBX)](https://codecov.io/gh/brenoroosevelt/flex-fqcn-finder)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE.md)

The Flex FQCN Finder allows you to find all the Fully Qualified Class Names (FQCN) available in a project. This package was designed to be flexible and reliable.
## Features

- Find classes, traits and interfaces (PSR-4 complaint);
- Search in directories (recursively or not);
- Many filter options;
- Cache (PSR-16 complaint).
- Composite finders. 
- Get classes from Composer ClassMap. 

## Requirements

* The following versions of PHP are supported:  `^8`.
* For PHP 7.*, please install version 1.0.0

## Install

``` bash
$ composer require brenoroosevelt/flex-fqcn-finder
```

## Usage
Use the `FlexFqcnFinder\Fqcn` helper to apply filters, decorators and compositions on your own way.

```php
<?php
use FlexFqcnFinder\Fqcn;
use FlexFqcnFinder\Filter\Filter;

$recursive = true;

$fqcns = 
    Fqcn::new()
        ->addDirectory('/path/to/dir1', $recursive)
        ->addDirectory('/path/to/dir2', !$recursive)
        ->withFilter(
            Filter::by() // or: Filter::anyOf()
                ->implementsInterface('MyInterface')
                ->hasMethod('method')
        )
        ->includeDeclaredClasses()
        ->withCache(new MyPsr16Cache(), 'cacheKey')
        ->find();

var_dump($fqcns);
/* output
[
    'NamespaceA\FooClass',
    'NamespaceB\BarClass',
    'NamespaceC\Traits\HelperTrait'
]
*/
```

### Finders

Finders are classes that implement interface `FqcnFinderInterface` and return a list (array) of FQCNs found.
```php
<?php
namespace FlexFqcnFinder;

interface FqcnFinderInterface
{
    /**
     * @return string[] The fully qualified class names found
     */
    public function find(): array;
}
```
This package provides some finders:
* `FlexFqcnFinder\Finder\FqcnFinder` (find classes, traits and interfaces in a directory)
* `FlexFqcnFinder\Finder\ComposerClassMap` (from Composer autoload classes)
* `FlexFqcnFinder\Finder\GetDeclaredClasses` (from `get_declared_classes()`)
* `FlexFqcnFinder\Finder\GetDeclaredInterfaces` (from `get_declared_interfaces()`)
* `FlexFqcnFinder\Finder\GetDeclaredTraits` (from `get_declared_traits()`)

### Composite

You can compose finders using the `FlexFqcnFinder\FqcnFinderComposite`:
```php
<?php
use FlexFqcnFinder\FqcnFinderComposite;
use FlexFqcnFinder\Finder\GetDeclaredClasses;
use FlexFqcnFinder\Finder\FqcnFinder;
use FlexFqcnFinder\Repository\FilesFromDir;

$myFinder = new FqcnFinderComposite(
    new GetDeclaredClasses(),
    new FqcnFinder(new FilesFromDir('path/to/dir1')),
    new FqcnFinder(new FilesFromDir('path/to/dir2'))
);

$fqcns = $myFinder->find();
```
### Decorators

Decorators available for Finders: 
* `FlexFqcnFinder\Finder\Decorator\CachedFqcnFinder`
* `FlexFqcnFinder\Finder\Decorator\FilteringFqcnFinder`

You can decorate any finder (including compositions):
```php
<?php
use FlexFqcnFinder\Finder\Decorator\CachedFqcnFinder;
use FlexFqcnFinder\Finder\Decorator\FilteringFqcnFinder;
use FlexFqcnFinder\Filter\Specifications\IsSubClassOf;

$myFinder = /* any finder, finder composition, ... */;

$filtered = new FilteringFqcnFinder(
    $myFinder,
    new IsSubClassOf('MyBaseClass')
);

// decorating again
$cached = new CachedFqcnFinder($filtered, new MyPsr16Cache(), 'cacheKey');

$fqcns = $cached->find();
```

#### Filters
Filters can be used as a Decorator for Finders and using it is optional.

All filters have been designed according to the Specification Pattern. You can chain the following filters using `Filter::by()` or `Filter::anyOf()`:

* `apply(Closure $fn)`
* `belongsToNamespace(string $namespace)`
* `classNameEndsWith(string $value)`
* `classNameStartsWith(string $value)`
* `hasMethod(string $method)`
* `implementsInterface(string $interface)`
* `isAbstract()`
* `isClass()`
* `isCloneable()`
* `isFinal()`
* `isInstanceOf(string $subject)`
* `isInstantiable()`
* `isInterface()`
* `isInternal()`
* `isIterateable()`
* `isSubClassOf(string $class)`
* `isTrait()`
* `isUserDefined()`
* `namespaceEqualsTo(string $namespace)`
* `not(FqcnSpecification $specification)`
* `useTrait(string $trait)`
* `anyOf(FqcnSpecification ...$specifications)`
* `allOf(FqcnSpecification ...$specifications)`
* `and(FqcnSpecification ...$specifications)`
* `or(FqcnSpecification ...$specifications)`

Any filter can be used with `FlexFqcnFinder\Finder\Decorator\FilteringFqcnFinder` decorator:

```php
<?php
use FlexFqcnFinder\Finder\FqcnFinder;
use FlexFqcnFinder\Repository\FilesFromDir;
use FlexFqcnFinder\Finder\Decorator\FilteringFqcnFinder;
use FlexFqcnFinder\Filter\Specifications\IsSubClassOf;

$filtered = new FilteringFqcnFinder(
    new FqcnFinder(new FilesFromDir(__DIR__)),  //  first param: decorated Finder
    new IsSubClassOf('MyBaseClass')             // second param: filters to apply
);

// Or chaining filters:

$filtered = new FilteringFqcnFinder(
    new FqcnFinder(new FilesFromDir(__DIR__)),
    Filter::anyOf()
        ->implementsInterface('MyInterface')
        ->hasMethod('execute')
        ->and(
            Filter::by()
                ->usingTrait('MyTrait')
                ->apply(function($fqcn) {
                    return $fqcn === 'my_condition';
                })
        )
);

$fqcns = $filtered->find();
```

#### Creating Filters
You can create you own filter implementing interface `FqcnSpecification`:

```php
<?php
namespace Foo;

use FlexFqcnFinder\Filter\FqcnSpecification;

MyFilter implements FqcnSpecification
{
    public function isSatisfiedBy(string $fqcn): bool
    {
        return $fqcn === /* ... */;
    }
}
```
So just use it:

```php
<?php
use FlexFqcnFinder\Finder\FqcnFinder;
use FlexFqcnFinder\Repository\FilesFromDir;
use FlexFqcnFinder\Finder\Decorator\FilteringFqcnFinder;
use namespace Foo\MyFilter;

$filtered = new FilteringFqcnFinder(
    new FqcnFinder(new FilesFromDir(__DIR__)),
    new MyFilter()
);

$fqcns = $filtered->find();

```

## Contributing

Please read the Contributing guide to learn about contributing to this project.

## License

This project is licensed under the terms of the MIT license. See the [LICENSE](LICENSE.md) file for license rights and limitations.
