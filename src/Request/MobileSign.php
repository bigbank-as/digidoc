<?php
namespace Bigbank\MobileId\Request;

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
            'Sesscode'                    => '',
            'SignerIDCode'                => '',
            'SignersCountry'              => 'EE',
            'SignerPhoneNo'               => '',
            'ServiceName'                 => '',
            'AdditionalDataToBeDisplayed' => '',
            'Language'                    => 'EST',
            'Role'                        => '',
            'City'                        => '',
            'StateOrProvince'             => '',
            'PostalCode'                  => '',
            'CountryName'                 => '',
            'SigningProfile'              => '',
            'MessagingMode'               => 'asynchClientServer',
            'AsyncConfiguration'          => null,
            'ReturnDocInfo'               => false,
            'ReturnDocData'               => false
        ];
    }
}
