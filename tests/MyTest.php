<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test;

use FlexFqcnFinder\Filter\Filter;
use FlexFqcnFinder\Finder\ComposerClassMap;
use FlexFqcnFinder\Finder\Decorator\FilteringFqcnFinder;
use FlexFqcnFinder\Finder\FqcnFinder;
use FlexFqcnFinder\Fqcn;
use FlexFqcnFinder\FqcnFinderInterface;
use FlexFqcnFinder\Repository\FileRepositoryInterface;
use FlexFqcnFinder\Repository\FilesFromDir;
use Gnugat\NomoSpaco\FqcnRepository;
use PHPStan\Testing\TestCase;

class MyTest extends TestCase
{
    public function testSuccess()
    {
        $fqcn =
            Fqcn::fromDir(__DIR__ . '/../src')
                ->withFilter(
                    Filter::by()->isInstanceOf(FqcnFinderInterface::class)
                )
                ->find();

        $this->assertNotEmpty($fqcn);
    }
}
