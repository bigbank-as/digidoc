<?php
namespace Bigbank\DigiDoc\Services\MobileId;

use Bigbank\DigiDoc\Exceptions\IdException;
use Bigbank\DigiDoc\Services\AbstractDigiDocService;

/**
 * {@inheritdoc}
 */
class DefaultAuthenticator extends AbstractDigiDocService implements Authenticator
{

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
            null,
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
            throw new IdException('Server', 'Could not get status from response.');
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
}
