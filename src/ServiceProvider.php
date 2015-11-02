<?php
namespace Bigbank\DigiDoc;

use Bigbank\DigiDoc\Requests\GetMobileAuthenticateStatus;
use Bigbank\DigiDoc\Requests\MobileAuthenticate;
use Bigbank\DigiDoc\Services\MobileId\Authenticator;
use Bigbank\DigiDoc\Services\MobileId\AuthenticatorInterface;
use Bigbank\DigiDoc\Soap\ProxyAwareClient;
use Bigbank\DigiDoc\Soap\SoapClient;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        SoapClient::class,
        AuthenticatorInterface::class,
        MobileAuthenticate::class,
        GetMobileAuthenticateStatus::class
    ];

    /**
     * @var string
     */
    protected $apiUrl;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {

        $container = $this->getContainer();

        $container->add(SoapClient::class, function () {

            $proxy = getenv('HTTP_PROXY') ?: null;

            if ($proxy) {
                $this->options['proxy_host'] = parse_url($proxy, PHP_URL_HOST);
                $this->options['proxy_port'] = parse_url($proxy, PHP_URL_PORT);
            }

            return new ProxyAwareClient($this->apiUrl, $this->options);
        });

        $container->add(AuthenticatorInterface::class, Authenticator::class)
            ->withArgument(MobileAuthenticate::class)
            ->withArgument(GetMobileAuthenticateStatus::class);


        $container->add(MobileAuthenticate::class, MobileAuthenticate::class)
            ->withArgument(SoapClient::class);
        $container->add(GetMobileAuthenticateStatus::class, GetMobileAuthenticateStatus::class)
            ->withArgument(SoapClient::class);

    }

    public function setApiUrl($apiUrl)
    {

        $this->apiUrl = $apiUrl;
        return $this;
    }

    public function setOptions(array $options)
    {

        $this->options = $options;
        return $this;

    }
}
