<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Finder;

use Composer\Autoload\ClassLoader;
use FlexFqcnFinder\FqcnFinderInterface;
use InvalidArgumentException;

/**
 * Including all available classes (vendor + your project); use:
 * $ composer dump-autoload -o
 */
class ComposerClassMap implements FqcnFinderInterface
{
    /**
     * @var string The path to your composer 'vendor/autoload.php'
     */
    protected $composerAutoloadPath;

    public function __construct(string $composerAutoloadPath)
    {
        $this->composerAutoloadPath = $composerAutoloadPath;
    }

    public function find(): array
    {
        if (!file_exists($this->composerAutoloadPath)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Cannot get Composer class map. Invalid path: %s.",
                    $this->composerAutoloadPath
                )
            );
        }

        $classLoader = require($this->composerAutoloadPath);
        if (! $classLoader instanceof ClassLoader) {
            throw new InvalidArgumentException(
                sprintf(
                    "Cannot get Composer class map. Invalid composer autoload: %s.",
                    $this->composerAutoloadPath
                )
            );
        }

        return array_keys($classLoader->getClassMap());
    }
}
