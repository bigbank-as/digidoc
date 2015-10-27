<?php

namespace Bigbank\MobileId;

use Bigbank\MobileId\Requests\ServiceProvider as RequestServiceProvider;
use Bigbank\MobileId\ServiceProvider as SystemServiceProvider;
use Bigbank\MobileId\Services\ServiceProvider as ServiceProvider;
use League\Container\Container;
use League\Container\ContainerInterface;

class MobileId
{

    /**
     * @var string
     */
    const URL_PRODUCTION = 'https://digidocservice.sk.ee/?wsdl';

    /**
     * @var string
     */
    const URL_TEST = 'https://tsp.demo.sk.ee?wsdl';

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct($apiUrl, array $options = [])
    {

        $this->container = $this->containerFactory($apiUrl, $options);
    }

    public function getService($service)
    {

        return $this->container->get($service);
    }

    private function containerFactory($apiUrl, array $options = [])
    {

        $container = new Container;

        $systemServiceProvider = new SystemServiceProvider;
        $systemServiceProvider->setApiUrl($apiUrl)
            ->setOptions($options);

        $container->addServiceProvider($systemServiceProvider)
            ->addServiceProvider(RequestServiceProvider::class)
            ->addServiceProvider(ServiceProvider::class);

        return $container;
    }


    public function getContainer()
    {

        return $this->container;
    }
}
