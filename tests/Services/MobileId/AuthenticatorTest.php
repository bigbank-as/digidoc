<?php

namespace Bigbank\DigiDoc\Test;

use Bigbank\DigiDoc\Services\MobileId\Authenticator;
use Bigbank\DigiDoc\Soap\DigiDocServiceInterface;
use Bigbank\DigiDoc\Test\Soap\DummyDigiDocService;
use RandomLib\Factory;

/**
 * @coversDefaultClass \Bigbank\DigiDoc\Services\MobileId\Authenticator
 */
class AuthenticatorTest extends TestCase
{

    /**
     * @covers ::generateChallenge
     */
    public function testGenerateChallengeReturnsHexStringOfCorrectLength()
    {

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
                    return ctype_xdigit($randomString)
                    && mb_strlen($randomString) === Authenticator::SP_CHALLENGE_LENGTH;
                }),
                'asynchClientServer',
                null,
                false,
                false
            );
        $authenticator = new Authenticator($digiDocMock, (new Factory)->getMediumStrengthGenerator());
        $authenticator->authenticate('14212128025', '37200007', null, null);
    }
}
