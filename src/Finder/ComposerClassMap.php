<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Finder;

use Composer\Autoload\ClassLoader;
use FlexFqcnFinder\FqcnFinderInterface;
use ReflectionClass;

/**
 * Including all available classes (vendor + your project); use:
 * $ composer dump-autoload -o
 */
class ComposerClassMap implements FqcnFinderInterface
{
    public function find(): array
    {
        $reflection = new ReflectionClass(ClassLoader::class);
        $classMap = dirname($reflection->getFileName()) . DIRECTORY_SEPARATOR . "autoload_classmap.php";
        $classMapArray = require($classMap);
        return array_keys($classMapArray);
    }
}
