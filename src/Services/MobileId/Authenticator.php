<?php
namespace Bigbank\DigiDoc\Services\MobileId;

use Bigbank\DigiDoc\Exceptions\DigiDocException;
use Bigbank\DigiDoc\Services\AbstractService;
use Bigbank\DigiDoc\Soap\DigiDocServiceInterface;
use Bigbank\DigiDoc\Soap\InteractionStatus;
use RandomLib\Generator;

/**
 * {@inheritdoc}
 */
class Authenticator extends AbstractService implements AuthenticatorInterface
{

    /**
     * The length of client-side random token 'SPChallenge'
     */
    const SP_CHALLENGE_LENGTH = 20;

    /**
     * @var int
     */
    protected $pollingFrequency = 3;

    /**
     * @var Generator
     */
    private $random;

    /**
     * @param DigiDocServiceInterface $digiDocService
     * @param Generator               $random
     */
    public function __construct(DigiDocServiceInterface $digiDocService, Generator $random)
    {
        parent::__construct($digiDocService);
        $this->random = $random;
    }


    /**
     * {@inheritdoc}
     */
    public function authenticate($idCode, $phoneNumber, $serviceName, $messageToDisplay)
    {

        return $this->digiDocService->MobileAuthenticate(
            $idCode,
            'EE',
            $phoneNumber,
            'EST',
            $serviceName,
            $messageToDisplay,
            $this->generateChallenge(),
            'asynchClientServer',
            null,
            false,
            false
        );
    }

    /**
     * {@inheritdoc}
     */
    public function askStatus($sessionCode)
    {

        $statusResponse = $this->digiDocService->GetMobileAuthenticateStatus($sessionCode, false);

        if (!isset($statusResponse['Status'])) {
            throw new DigiDocException;
        }
        return $statusResponse['Status'];
    }

    /**
     * {@inheritdoc}
     */
    public function waitForAuthentication($sessionCode, callable $callback)
    {

        $status = InteractionStatus::OUTSTANDING_TRANSACTION;
        while ($status == InteractionStatus::OUTSTANDING_TRANSACTION) {
            $status = $this->askStatus($sessionCode);
            sleep($this->pollingFrequency);
        }

        return call_user_func($callback, $status, $sessionCode);
    }

    /**
     * Generates a random hexadecimal string for SPChallenge parameter of DigiDoc
     *
     * The generated string is cryptographically secure.
     *
     * @return string
     */
    private function generateChallenge()
    {
        return $this->random->generateString(self::SP_CHALLENGE_LENGTH, '0123456789abcdef');
    }
}
