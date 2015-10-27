<?php
namespace Bigbank\DigiDoc\Services;

use Bigbank\DigiDoc\Requests\GetMobileAuthenticateStatus;
use Bigbank\DigiDoc\Requests\MobileAuthenticate;
use Bigbank\DigiDoc\Services\MobileId\Authenticator;
use Bigbank\DigiDoc\Services\MobileId\AuthenticatorInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        AuthenticatorInterface::class
    ];

    /**
     * {@inheritdoc}
     */
    public function register()
    {

        $container = $this->getContainer();
        $container->add(AuthenticatorInterface::class, Authenticator::class)
            ->withArgument(MobileAuthenticate::class)
            ->withArgument(GetMobileAuthenticateStatus::class);

    }
}
