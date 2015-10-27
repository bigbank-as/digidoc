<?php
namespace Bigbank\MobileId\Requests;

use Bigbank\MobileId\SoapClientInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        MobileAuthenticate::class,
        GetMobileAuthenticateStatus::class
    ];

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

        foreach ($this->provides as $class) {
            $container->add($class, $class)
                ->withArgument(SoapClientInterface::class);
        }
    }
}
