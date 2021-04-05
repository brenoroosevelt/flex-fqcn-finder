# Flex FQCN Finder
[![Build](https://github.com/brenoroosevelt/flex-fqcn-finder/actions/workflows/ci.yml/badge.svg)](https://github.com/brenoroosevelt/oni-bus/actions/workflows/ci.yml)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/brenoroosevelt/flex-fqcn-finder/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/brenoroosevelt/flex-fqcn-finder/?branch=main)
[![codecov](https://codecov.io/gh/brenoroosevelt/flex-fqcn-finder/branch/main/graph/badge.svg?token=S1QBA18IBX)](https://codecov.io/gh/brenoroosevelt/flex-fqcn-finder)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE.md)

The Flex FQCN Finder allows you to find all the Fully Qualified Class Names (FQCN) available in a project. This package was designed to be fast, flexible and reliable.
## Features

This package supports:

- Find classes, traits and interfaces;
- Search in directories (recursively or not);
- Apply filters;
- Use cache (PSR-16).
- Compose finders with declared classes, traits and interfaces. 

## Requirements

This package supports the following versions of PHP:

* PHP 7.0
* PHP 7.1
* PHP 7.2
* PHP 7.3
* PHP 7.4
* PHP 8.0

## Install

Via Composer

``` bash
$ composer require brenoroosevelt/flex-fqcn-finder
```
## Usage

```php
<?php
use FlexFqcnFinder\Fqcn;
use FlexFqcnFinder\Filter\Filter;

$recursive = true;

$fqcns = Fqcn::new()
            ->addDirectory('/path/to/dir1', $recursive)
            ->addDirectory('/path/to/dir2', $recursive)
            ->withFilter(
                Filter::by()  // or: Filter::anyOf()
                    ->implementsInterface(MyInterface::class)
                    ->hasMethod('method')
                    ->isInstantiable()
                    ->classNameEndsWith('Suffix')
            )
            ->includeDeclaredClasses()
            ->withCache(new MyPsr16Cache(), 'cacheKey')
            ->find();
```

### Filters
The filters were designed according to the Specification Pattern. You can chain the following filters using `Filter::by()` or `Filter::anyOf()`:

* `apply(Closure $fn)`
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
* `usingTrait(string $trait)`
* `anyOf(FqcnSpecification $specification, FqcnSpecification ...$specifications)`
* `allOf(FqcnSpecification $specification, FqcnSpecification ...$specifications)`
* `and(FqcnSpecification $specification, FqcnSpecification ...$specifications)`
* `or(FqcnSpecification $specification, FqcnSpecification ...$specifications)`

### Composite and Decorator

As you could see above, this package provides a helper for composing and creating filters. However, you can use the filters, decorators and compositions on your own.

Finders are classes that implements interface `FqcnFinderInterface`. This package provides some finders:
* `FlexFqcnFinder\Finder\FqcnFinder` (find in a directory)
* `FlexFqcnFinder\Finder\GetDeclaredClasses`
* `FlexFqcnFinder\Finder\GetDeclaredInterfaces`
* `FlexFqcnFinder\Finder\GetDeclaredTraits`

You can compose finders using `FlexFqcnFinder\FqcnFinderComposite`:
```php
<?php
use FlexFqcnFinder\FqcnFinderComposite;
use FlexFqcnFinder\Finder\GetDeclaredClasses;
use FlexFqcnFinder\Finder\FqcnFinder;
use FlexFqcnFinder\Repository\FilesFromDir;

$myFinder = new FqcnFinderComposite(
    new GetDeclaredClasses(),
    new FqcnFinder(new FilesFromDir(__DIR__))
);
```

This package provides some decorators: 
* `FlexFqcnFinder\Finder\Decorator\CachedFqcnFinder`
* `FlexFqcnFinder\Finder\Decorator\FilteringFqcnFinder`

You can decorate your finder (including compositions):
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

## Contributing

Please read the Contributing guide to learn about contributing to this project.

## License

This project is licensed under the terms of the MIT license. See the [LICENSE](LICENSE.md) file for license rights and limitations.