<?php
namespace Bigbank\MobileId\Request;

/**
 * Get the status of mobile ID authentication process
 */
class GetMobileAuthenticateStatus extends AbstractRequest
{


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
