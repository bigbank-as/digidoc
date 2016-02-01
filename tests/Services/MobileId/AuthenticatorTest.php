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
     * @var \PHPUnit_Framework_MockObject_MockObject|DigiDocServiceInterface $digiDocMock
     */
    protected $digiDocMock;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->digiDocMock = $this->getMock(DummyDigiDocService::class, ['MobileAuthenticate']);
    }

    /**
     * @covers ::generateChallenge
     */
    public function testGenerateChallengeReturnsHexStringOfCorrectLength()
    {
        $this->digiDocMock->expects($this->once())
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
        $authenticator = $this->authenticatorFactory();
        $authenticator->authenticate('14212128025', '37200007', null, null);
    }


    /**
     * @return Authenticator
     */
    private function authenticatorFactory()
    {
        return new Authenticator($this->digiDocMock, (new Factory)->getLowStrengthGenerator());
    }
}
