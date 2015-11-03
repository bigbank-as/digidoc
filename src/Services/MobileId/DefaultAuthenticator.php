<?php
namespace Bigbank\DigiDoc\Services\MobileId;

use Bigbank\DigiDoc\Exceptions\DigiDocException;
use Bigbank\DigiDoc\Services\AbstractDigiDocService;

/**
 * {@inheritdoc}
 */
class DefaultAuthenticator extends AbstractDigiDocService implements Authenticator
{

    const SP_CHALLENGE_LENGTH = 20;

    /**
     * @var int
     */
    protected $pollingFrequency = 3;

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

        $status = 'OUTSTANDING_TRANSACTION';
        while ($status == 'OUTSTANDING_TRANSACTION') {
            $status = $this->askStatus($sessionCode);
            sleep($this->pollingFrequency);
        }

        return call_user_func($callback, $status, $sessionCode);
    }

    /**
     * Generates a random 10-byte string
     *
     * The generated string is cryptographically secure if the function `random_bytes` is available (>= PHP 7).
     *
     * @return int|string
     */
    private function generateChallenge()
    {

        if (function_exists('random_bytes')) {
            return random_bytes(self::SP_CHALLENGE_LENGTH);
        }

        $randomString = bin2hex(openssl_random_pseudo_bytes(self::SP_CHALLENGE_LENGTH));
        return substr($randomString, 0, self::SP_CHALLENGE_LENGTH);
    }
}
