<?php

namespace Bigbank\DigiDoc;

use Bigbank\DigiDoc\Requests\ServiceProvider as RequestServiceProvider;
use Bigbank\DigiDoc\ServiceProvider as SystemServiceProvider;
use Bigbank\DigiDoc\Services\ServiceProvider as ServiceProvider;
use League\Container\Container;
use League\Container\ContainerInterface;

/**
 * {@inheritdoc}
 */
class DigiDoc implements DigiDocInterface
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

    /**
     * @param string $apiUrl
     * @param array  $options
     */
    public function __construct($apiUrl, array $options = [])
    {

        $this->container = $this->containerFactory($apiUrl, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getService($service)
    {

        return $this->container->get($service);
    }

    /**
     * @param string $apiUrl
     * @param array  $options
     *
     * @return Container
     */
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


    /**
     * {@inheritdoc}
     */
    public function getContainer()
    {

        return $this->container;
    }
}
