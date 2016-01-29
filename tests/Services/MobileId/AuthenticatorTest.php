<?php

namespace Bigbank\DigiDoc\Test;

use Bigbank\DigiDoc\Services\MobileId\Authenticator;
use Bigbank\DigiDoc\Soap\DigiDocServiceInterface;
use Bigbank\DigiDoc\Test\Soap\DummyDigiDocService;

/**
 * @coversDefaultClass \Bigbank\DigiDoc\Services\MobileId\Authenticator
 */
class AuthenticatorTest extends TestCase
{

    /**
     * @covers ::generateChallenge
     */
    public function testGenerateChallengeReturnsUtf8StringWhenRunWithPhp7()
    {

        $this->requirePhpVersion('7.0');

        /** @var \PHPUnit_Framework_MockObject_MockObject|DigiDocServiceInterface $digiDocMock */
        $digiDocMock = $this->getMock(DummyDigiDocService::class, ['MobileAuthenticate']);

        $digiDocMock->expects($this->once())
            ->method('MobileAuthenticate')
            ->with(
                '14212128025',
                'EE',
                '+37200007',
                'EST',
                null,
                null,
                $this->callback(function ($randomString) {
                    return mb_check_encoding($randomString, 'UTF-8');
                }),
                'asynchClientServer',
                null,
                false,
                false
            );
        $authenticator = new Authenticator($digiDocMock);
        $authenticator->authenticate('14212128025', '37200007', null, null);
    }
}
