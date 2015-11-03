<?php
namespace Bigbank\DigiDoc;

use Bigbank\DigiDoc\Services\MobileId\Authenticator;
use Bigbank\DigiDoc\Services\MobileId\DefaultAuthenticator;
use Bigbank\DigiDoc\Services\MobileId\DefaultFileSigner;
use Bigbank\DigiDoc\Services\MobileId\FileSigner;
use Bigbank\DigiDoc\Soap\DigiDocService;
use Bigbank\DigiDoc\Soap\SkDigiDoc;
use Bigbank\DigiDoc\Soap\SoapClient;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        SoapClient::class,
        Authenticator::class,
        FileSigner::class
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

        $container->add(DigiDocService::class, function () {

            $proxy = getenv('HTTP_PROXY') ?: null;

            if ($proxy) {
                $this->options['proxy_host'] = parse_url($proxy, PHP_URL_HOST);
                $this->options['proxy_port'] = parse_url($proxy, PHP_URL_PORT);
            }

            return new SkDigiDoc($this->options, $this->apiUrl);
        });

        $container->add(
            Authenticator::class,
            DefaultAuthenticator::class
        )->withArgument(DigiDocService::class);

        $container->add(
            FileSigner::class,
            DefaultFileSigner::class
        )->withArgument(DigiDocService::class);
    }

    /**
     * @param string $apiUrl
     *
     * @return $this
     */
    public function setApiUrl($apiUrl)
    {

        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions(array $options)
    {

        $this->options = $options;
        return $this;
    }
}
