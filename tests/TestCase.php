<?php
declare(strict_types=1);

namespace FlexFqcnFinder\Test;

define('DS', DIRECTORY_SEPARATOR);
define('FIXTURES_DIR', __DIR__ . DS . 'Fixtures');

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function assertArrayEquals(array $arr1, array $arr2, string $message = null)
    {
        $message = $message ?? 'Failed asserting array equals.';
        $this->assertEmpty(array_diff($arr1, $arr2), $message);
    }
}
