<?php
namespace Bigbank\DigiDoc\Requests;

/**
 * Get the status of mobile ID authentication process
 */
class GetMobileAuthenticateStatus extends AbstractRequest
{

    /**
     * Authentication is still on the way, ask again later
     */
    const OUTSTANDING_TRANSACTION = 'OUTSTANDING_TRANSACTION';

    /**
     * Authentication successful
     */
    const USER_AUTHENTICATED = 'USER_AUTHENTICATED';

    /**
     * The action is completed but the signature created is not valid
     */
    const NOT_VALID = 'NOT_VALID';

    /**
     * Authentication timed out
     */
    const EXPIRED_TRANSACTION = 'EXPIRED_TRANSACTION';

    /**
     * The user cancelled
     */
    const USER_CANCEL = 'USER_CANCEL';

    /**
     * Mobile ID SIM card is not yet ready
     */
    const MID_NOT_READY = 'MID_NOT_READY';

    /**
     * The phone is switched off or out of service coverage
     */
    const PHONE_ABSENT = 'PHONE_ABSENT';

    /**
     * General error when sending the message
     *
     * (the phone is incapable of receiving the
     * message, error in messaging server etc.)
     */
    const SENDING_ERROR = 'SENDING_ERROR';

    /**
     * SIM application error
     */
    const SIM_ERROR = 'SIM_ERROR';

    /**
     * Error in the SOAP API
     */
    const INTERNAL_ERROR = 'INTERNAL_ERROR';

    /**
     * {@inheritdoc}
     */
    public function getDefaultArguments()
    {

        return [
            'Sesscode'      => 0,
            'WaitSignature' => false
        ];
    }
}
