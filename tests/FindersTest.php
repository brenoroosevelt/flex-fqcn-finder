<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test;

use FlexFqcnFinder\Finder\ComposerClassMap;
use FlexFqcnFinder\Finder\FqcnFinder;
use FlexFqcnFinder\Finder\GetDeclaredClasses;
use FlexFqcnFinder\Finder\GetDeclaredInterfaces;
use FlexFqcnFinder\Finder\GetDeclaredTraits;
use FlexFqcnFinder\Test\Stubs\FixedRepository;
use InvalidArgumentException;

class FindersTest extends TestCase
{
    public function testGetDeclaredClasses()
    {
        $finder = new GetDeclaredClasses();
        $this->assertEquals(get_declared_classes(), $finder->find());
    }

    public function testGetDeclaredTraits()
    {
        $finder = new GetDeclaredTraits();
        $this->assertEquals(get_declared_traits(), $finder->find());
    }

    public function testGetDeclaredInterfaces()
    {
        $finder = new GetDeclaredInterfaces();
        $this->assertEquals(get_declared_interfaces(), $finder->find());
    }

    public function testComposerClassMap()
    {
        $finder = new ComposerClassMap();
        $this->assertNotEmpty($finder->find());
    }

    public function testFqcnFinder()
    {
        $finder = new FqcnFinder(new FixedRepository([
            FIXTURES_DIR . DS . 'Dir1' . DS . 'Dir11' . DS . 'Dir111' . DS . 'ClassA.php',
            FIXTURES_DIR . DS . 'Dir1' . DS . 'Dir11' . DS . 'Dir111' . DS . 'TraitA.php',
            FIXTURES_DIR . DS . 'Dir1' . DS . 'Dir11' . DS . 'Dir111' . DS . 'InterfaceA.php',
        ]));

        $expected = [
            'FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\ClassA',
            'FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\TraitA',
            'FlexFqcnFinder\Test\Fixtures\Dir1\Dir11\Dir111\InterfaceA',
        ];

        $result = $finder->find();
        $this->assertEmpty(array_diff($expected, $result));
    }
}
