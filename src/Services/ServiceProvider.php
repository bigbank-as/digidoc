<?php
namespace Bigbank\MobileId\Services;

use Bigbank\MobileId\Requests\GetMobileAuthenticateStatus;
use Bigbank\MobileId\Requests\MobileAuthenticate;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        AuthenticatorInterface::class
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
        $container->add(AuthenticatorInterface::class, Authenticator::class)
            ->withArgument(MobileAuthenticate::class)
            ->withArgument(GetMobileAuthenticateStatus::class);

    }
}
