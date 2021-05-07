<?php

declare(strict_types=1);

namespace RebelWalls\LaravelProxicore\Tests;

class AAASmokeTest extends TestCase
{
    public const MIN_PHP_VERSION = '7.4.0';

    /**
     * @test
     * @return void
     */
    public function smoke()
    {
        $this->assertTrue(true);
    }

    /**
     * Test for minimum PHP version
     *
     * @depends smoke
     * @return void
     */
    public function testPhpVersionSatisfiesRequirements()
    {
        $this->assertFalse(
            version_compare(PHP_VERSION, self::MIN_PHP_VERSION, '<'),
            'PHP version ' . self::MIN_PHP_VERSION . ' or greater is required but only '
            . PHP_VERSION . ' found.'
        );
    }
}
