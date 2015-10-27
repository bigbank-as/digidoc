<?php

namespace Bigbank\MobileId;

use Bigbank\MobileId\Request\GetMobileAuthenticateStatus;
use Bigbank\MobileId\Request\MobileAuthenticate;
use Bigbank\MobileId\Request\ServiceProvider;
use League\Container\Container;
use League\Container\ContainerInterface;

class MobileId
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct()
    {

        $this->container = $this->containerFactory();
    }

    public function getService($service)
    {

        return $this->container->get($service);
    }

    private function containerFactory()
    {

        $container = new Container;
        $container->add(SoapClientInterface::class, function () {

            $options = [];

            $proxy = getenv('HTTP_PROXY') ?: null;

            if ($proxy) {
                $options['proxy_host'] = parse_url($proxy, PHP_URL_HOST);
                $options['proxy_port'] = parse_url($proxy, PHP_URL_PORT);
            }
            return new SoapClient(SoapClient::URL_TEST, $options);
        });

      $container->addServiceProvider(ServiceProvider::class);

        $container->add(AuthenticatorInterface::class, Authenticator::class)
            ->withArgument(MobileAuthenticate::class)
            ->withArgument(GetMobileAuthenticateStatus::class);

        return $container;
    }
}
