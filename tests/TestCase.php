<?php

namespace Bigbank\DigiDoc\Test;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * Skip the test if PHP version is too low
     *
     * @param string $version PHP version number needed to run the test
     */
    protected function requirePhpVersion($version)
    {
        if (version_compare(PHP_VERSION, $version) === -1) {
            $this->markTestSkipped(sprintf('Skipping test, need at least PHP version %s to run.', $version));
        }
    }
}
