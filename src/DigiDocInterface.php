<?php
namespace Bigbank\DigiDoc;

use League\Container\ContainerInterface;

/**
 * Main DigiDoc class
 *
 * Boots the DI container and returns service instances.
 */
interface DigiDocInterface
{

    /**
     * @param string $service
     *
     * @return mixed
     */
    public function getService($service);

    /**
     * @return ContainerInterface
     */
    public function getContainer();
}
