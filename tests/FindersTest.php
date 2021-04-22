<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test;

use FlexFqcnFinder\Finder\ComposerClassMap;
use FlexFqcnFinder\Finder\GetDeclaredClasses;
use FlexFqcnFinder\Finder\GetDeclaredInterfaces;
use FlexFqcnFinder\Finder\GetDeclaredTraits;

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
        $finder = new ComposerClassMap(__DIR__ . DS . ".." . DS . "vendor" . DS . "autoload.php");
        $this->assertNotEmpty($finder->find());
    }
}
