<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test;

use FlexFqcnFinder\Filter\Specifications\AlwaysFalse;
use FlexFqcnFinder\Filter\Specifications\AlwaysTrue;
use FlexFqcnFinder\Finder\ComposerClassMap;
use FlexFqcnFinder\Finder\FqcnFinder;
use FlexFqcnFinder\Finder\GetDeclaredClasses;
use FlexFqcnFinder\Finder\GetDeclaredInterfaces;
use FlexFqcnFinder\Finder\GetDeclaredTraits;
use FlexFqcnFinder\Fqcn;
use FlexFqcnFinder\Repository\FilesFromDir;
use FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA;
use FlexFqcnFinder\Test\Stubs\FixedArrayFqcnFinder;
use FlexFqcnFinder\Test\Stubs\Psr16ArrayCache;

class FqcnTest extends TestCase
{
    public function testFqcnWithFilter()
    {
        $fqcn = Fqcn::new();
        $fqcn->compose(new FixedArrayFqcnFinder([ClassA::class]));
        $fqcn->withFilter(new AlwaysFalse());

        $result = $fqcn->find();

        $this->assertEmpty($result);
    }

    public function testFqcnAddDirectoryRecursive()
    {
        $fqcn = Fqcn::new();
        $fqcn->compose(new FixedArrayFqcnFinder([ClassA::class]));
        $fqcn->addDirectory(FIXTURES_DIR);

        $result = $fqcn->find();

        $this->assertCount(9, $result);
    }

    public function testFqcnWithCache()
    {
        $fqcn = Fqcn::new();
        $fqcn->compose(new FixedArrayFqcnFinder([ClassA::class]));
        $fqcn->withCache($cache = new Psr16ArrayCache(), 'key');

        $result = $fqcn->find();
        $cached = $cache->get('key');

        $this->assertArrayEquals($result, $cached);
    }

    public function testFqcnWithDeclaredClasses()
    {
        $fqcn = Fqcn::new();
        $fqcn->includeDeclaredClasses();
        $result = $fqcn->find();
        $classes = (new GetDeclaredClasses())->find();

        $this->assertArrayEquals($result, $classes);
    }

    public function testFqcnWithDeclaredTraits()
    {
        $fqcn = Fqcn::new();
        $fqcn->includeDeclaredTraits();
        $result = $fqcn->find();
        $traits = (new GetDeclaredTraits())->find();

        $this->assertArrayEquals($result, $traits);
    }

    public function testFqcnWithDeclaredInterfaces()
    {
        $fqcn = Fqcn::new();
        $fqcn->includeDeclaredInterfaces();
        $result = $fqcn->find();
        $interfaces = (new GetDeclaredInterfaces())->find();

        $this->assertArrayEquals($result, $interfaces);
    }

    public function testFqcnWithComposerClassMap()
    {
        $fqcn = Fqcn::new();
        $fqcn->includeComposerClassMap();
        $result = $fqcn->find();
        $classes = (new ComposerClassMap())->find();

        $this->assertArrayEquals($result, $classes);
    }

    public function testFqcnIntegrationTest()
    {
        $fqcn = Fqcn::new()
            ->addDirectory(FIXTURES_DIR)
            ->compose($fixed = new FixedArrayFqcnFinder(['FixedClass']))
            ->includeDeclaredClasses()
            ->includeDeclaredInterfaces()
            ->includeComposerClassMap()
            ->includeDeclaredTraits()
            ->withFilter(new AlwaysTrue())
            ->withCache($cache = new Psr16ArrayCache(), 'key');

        $result = $fqcn->find();
        $expected = [];

        $expected[] = (new ComposerClassMap())->find();
        $expected[] = (new GetDeclaredTraits())->find();
        $expected[] = (new GetDeclaredInterfaces())->find();
        $expected[] = (new GetDeclaredClasses())->find();
        $expected[] = (new FqcnFinder(new FilesFromDir(FIXTURES_DIR)))->find();
        $expected[] = $fixed->find();

        foreach ($expected as $item) {
            foreach ($item as $class) {
                $this->assertTrue(in_array($class, $result));
            }
        }

        $cached = $cache->get('key');
        $this->assertArrayEquals($result, $cached);
    }
}
