<?php
namespace Bigbank\DigiDoc\Soap;

/**
 * Holds possible values for the `Status` parameter for certain DigiDoc SOAP responses
 *
 * SOAP requests that return a `Status` key include:
 *
 *   - GetMobileAuthenticateStatus
 *   - GetStatusInfo
 *   - GetMobileCreateSignatureStatus
 *   - GetMobileSignHashStatusRequest
 *
 * @see http://www.sk.ee/upload/files/DigiDocService_spec_eng.pdf Section 7.2, response parameter "Status"
 */
final class InteractionStatus
{

    /**
     * Authentication is still on the way, ask again later
     */
    const OUTSTANDING_TRANSACTION = 'OUTSTANDING_TRANSACTION';

    /**
     * Signature was created
     */
    const SIGNATURE = 'SIGNATURE';

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
     * For IdCard signatures
     */
    const OK = 'OK';
}
