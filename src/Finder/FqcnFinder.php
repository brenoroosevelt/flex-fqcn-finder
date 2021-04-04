<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Finder;

use FlexFqcnFinder\FqcnFinderInterface;
use FlexFqcnFinder\Repository\FileRepositoryInterface;

class FqcnFinder implements FqcnFinderInterface
{
    /**
     * @var FileRepositoryInterface
     */
    protected $phpFileRepository;

    public function __construct(FileRepositoryInterface $phpFileRepository)
    {
        $this->phpFileRepository = $phpFileRepository;
    }

    /**
     * @inheritDoc
     */
    public function find(): array
    {
        $fqcn = [];
        foreach ($this->phpFileRepository->getFiles() as $file) {
            $className = $this->getFqcnFromFile($file);
            if (!empty($className)) {
                $fqcn[] = $className;
            }
        }

        return $fqcn;
    }

    /**
     * @param string $phpFile
     * @return string|null
     */
    protected function getFqcnFromFile(string $phpFile)
    {
        $tokens = token_get_all((string) file_get_contents($phpFile));
        $count = count($tokens);
        $className = [];
        for ($i = 0; $i < $count; $i++) {
            if ($this->hasNamespace($tokens, $i) && empty($className)) {
                $className[] = $this->getNamespace($tokens, $i);
            }

            if ($this->hasClassName($tokens, $i)) {
                $className[] = $this->getClassName($tokens, $i);
                return implode('\\', $className);  // one class per file (psr-4 compliant)
            }
        }

        return null;
    }

    protected function hasNamespace(array $tokens, int $index): bool
    {
        return isset($tokens[$index][0]) && T_NAMESPACE === $tokens[$index][0];
    }

    protected function hasClassName(array $tokens, int $index): bool
    {
        return
            isset($tokens[$index][0]) &&
            (T_CLASS === $tokens[$index][0] || T_TRAIT === $tokens[$index][0] || T_INTERFACE === $tokens[$index][0]) &&
            T_WHITESPACE === $tokens[$index + 1][0] &&
            T_STRING === $tokens[$index + 2][0];
    }

    protected function getNamespace(array $tokens, $index): string
    {
        $namespace = '';
        $index += 2;
        while (isset($tokens[$index]) && is_array($tokens[$index])) {
            $namespace .= $tokens[$index++][1];
        }

        return $namespace;
    }

    protected function getClassName(array $tokens, $index): string
    {
        return $tokens[$index + 2][1];
    }
}
