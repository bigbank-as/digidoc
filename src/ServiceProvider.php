<?php
namespace Bigbank\DigiDoc;

use Bigbank\DigiDoc\Services\MobileId\Authenticator;
use Bigbank\DigiDoc\Services\MobileId\AuthenticatorInterface;
use Bigbank\DigiDoc\Services\MobileId\FileSigner;
use Bigbank\DigiDoc\Services\MobileId\FileSignerInterface;
use Bigbank\DigiDoc\Services\IdCard\FileSignerInterface as IdCardFileSignerInterface;
use Bigbank\DigiDoc\Services\IdCard\FileSigner as IdCardFileSigner;
use Bigbank\DigiDoc\Soap\DigiDocServiceInterface;
use Bigbank\DigiDoc\Soap\SkDigiDocService;
use Bigbank\DigiDoc\Soap\SoapClientInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;
use RandomLib\Factory;

/**
 * DI service provider
 */
class ServiceProvider extends AbstractServiceProvider
{

    /**
     * @var array
     */
    protected $provides = [
        SoapClientInterface::class,
        AuthenticatorInterface::class,
        FileSignerInterface::class,
        IdCardFileSignerInterface::class
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

        $container->add(DigiDocServiceInterface::class, function () {

            $proxy = getenv('HTTP_PROXY') ?: null;

            if ($proxy) {
                $this->options['proxy_host'] = parse_url($proxy, PHP_URL_HOST);
                $this->options['proxy_port'] = parse_url($proxy, PHP_URL_PORT);
            }

            return new SkDigiDocService($this->options, $this->apiUrl);
        });

        $container->add(
            AuthenticatorInterface::class,
            Authenticator::class
        )->withArguments([DigiDocServiceInterface::class, (new Factory)->getMediumStrengthGenerator()]);

        $container->add(
            IdCardFileSignerInterface::class,
            IdCardFileSigner::class
        )->withArgument(DigiDocServiceInterface::class);

        $container->add(
            FileSignerInterface::class,
            FileSigner::class
        )->withArgument(DigiDocServiceInterface::class);
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
