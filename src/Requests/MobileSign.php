<?php
namespace Bigbank\MobileId\Requests;

/**
 * Initiate the signing process
 */
class MobileSign extends AbstractRequest
{

    /**
     * {@inheritdoc}
     */
    public function getDefaultArguments()
    {

        return [
            'Sesscode'                    => null,
            'SignerIDCode'                => null,
            'SignersCountry'              => 'EE',
            'SignerPhoneNo'               => null,
            'ServiceName'                 => null,
            'AdditionalDataToBeDisplayed' => null,
            'Language'                    => 'EST',
            'MessagingMode'               => 'asynchClientServer',
            'AsyncConfiguration'          => null,
            'ReturnDocInfo'               => false,
            'ReturnDocData'               => false
        ];
    }
}
