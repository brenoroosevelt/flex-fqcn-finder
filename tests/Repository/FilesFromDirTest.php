<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test\Repository;

use FlexFqcnFinder\Repository\FilesFromDir;
use FlexFqcnFinder\Test\TestCase;

class FilesFromDirTest extends TestCase
{
    public function testFindFilesInDirRecursive()
    {
        $basePath = realpath(FIXTURES_DIR);
        $filesFromDir = new FilesFromDir($basePath);
        $files = iterator_to_array($filesFromDir->getFiles());

        $expected = [
            $basePath . DS . 'Dir1' . DS . 'Dir11' . DS . 'file.php',
            $basePath . DS . 'Dir1' . DS . 'Dir11' . DS . 'Dir111' . DS . 'Class111.php',
        ];

        $this->assertSame($expected, $files);
    }

    public function testFindFilesInDir()
    {
        $basePath = realpath(FIXTURES_DIR . DS . 'Dir1' . DS . 'Dir11');
        $filesFromDir = new FilesFromDir($basePath, false);
        $files = iterator_to_array($filesFromDir->getFiles());

        $expected = [
            $basePath . DS . 'file.php',
        ];

        $this->assertSame($expected, $files);
    }
}
