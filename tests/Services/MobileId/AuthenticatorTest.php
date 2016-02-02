<?php

namespace Bigbank\DigiDoc\Test;

use Bigbank\DigiDoc\Services\MobileId\Authenticator;
use Bigbank\DigiDoc\Soap\DigiDocServiceInterface;
use Bigbank\DigiDoc\Soap\InteractionStatus;
use Bigbank\DigiDoc\Test\Soap\DummyDigiDocService;
use RandomLib\Factory;
use RandomLib\Generator;

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
     * @var Generator
     */
    protected $random;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->digiDocMock = $this->getMock(
            DummyDigiDocService::class,
            ['MobileAuthenticate', 'GetMobileAuthenticateStatus']
        );
        $this->random      = (new Factory)->getLowStrengthGenerator();
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
     * @covers ::waitForAuthentication
     */
    public function testWaitForAuthenticationContinuesWhenStatusChanges()
    {
        $authenticator = $this->getMock(Authenticator::class, ['askStatus'], [$this->digiDocMock, $this->random]);
        $authenticator->expects($this->exactly(2))
            ->method('askStatus')
            ->will($this->onConsecutiveCalls(
                InteractionStatus::OUTSTANDING_TRANSACTION,
                InteractionStatus::USER_CANCEL
            ));

        $authenticator->waitForAuthentication(
            function () {
            }
        );
    }

    /**
     * @covers ::waitForAuthentication
     */
    public function testWaitForAuthenticationCallsCallbackFunction()
    {
        $authenticator = $this->getMock(Authenticator::class, ['askStatus'], [$this->digiDocMock, $this->random]);
        $authenticator->expects($this->once())
            ->method('askStatus')
            ->willReturn(InteractionStatus::USER_CANCEL);

        $callback = $this->getMock(\stdClass::class, ['callback']);
        $callback->expects($this->once())
            ->method('callback')
            ->with(InteractionStatus::USER_CANCEL);

        $authenticator->waitForAuthentication([$callback, 'callback']);
    }

    /**
     * @covers ::waitForAuthentication
     */
    public function testWaitForAuthenticationHasAnInitialWaitPeriodBeforePolling()
    {

        $start = microtime(true);

        $authenticator = $this->getMock(Authenticator::class, ['askStatus'], [$this->digiDocMock, $this->random]);
        $authenticator->expects($this->once())
            ->method('askStatus')
            ->with($this->callback(function () use ($start) {
                // Verify that there's a sleep call before the first call to askStatus
                return microtime(true) - $start > Authenticator::INITIAL_WAIT_PERIOD;
            }))
            ->willReturn(InteractionStatus::USER_CANCEL);

        $authenticator->waitForAuthentication(
            function () {
            }
        );
    }

    /**
     * @covers ::askStatus
     * @expectedException \Bigbank\DigiDoc\Exceptions\DigiDocException
     */
    public function testAskStatusThrowsOnInvalidResponse()
    {
        $this->digiDocMock->expects($this->once())
            ->method('GetMobileAuthenticateStatus')
            ->willReturn([]);

        $this->authenticatorFactory()->askStatus();
    }

    /**
     * @covers ::askStatus
     */
    public function testAskStatusReturnsStatusAsString()
    {
        $this->digiDocMock->expects($this->once())
            ->method('GetMobileAuthenticateStatus')
            ->willReturn(['Status' => InteractionStatus::USER_CANCEL]);

        $status = $this->authenticatorFactory()->askStatus();
        $this->assertSame(InteractionStatus::USER_CANCEL, $status);
    }

    /**
     * @return Authenticator
     */
    private function authenticatorFactory()
    {
        return new Authenticator($this->digiDocMock, $this->random);
    }
}
