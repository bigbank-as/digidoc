<?php
namespace Bigbank\MobileId\Request;

/**
 * Start the two-step mobile ID authentication process
 */
class MobileAuthenticate extends AbstractRequest
{

    /**
     * {@inheritdoc}
     */
    public function getDefaultArguments()
    {

        return [
            'IDCode'               => null,
            'CountryCode'          => 'EE',
            'PhoneNo'              => null,
            'Language'             => 'EST',
            'ServiceName'          => null,
            'MessageToDisplay'     => null,
            'SPChallenge'          => null,
            'MessagingMode'        => 'asynchClientServer',
            'AsyncConfiguration'   => null,
            'ReturnCertData'       => false,
            'ReturnRevocationData' => false
        ];
    }
}
