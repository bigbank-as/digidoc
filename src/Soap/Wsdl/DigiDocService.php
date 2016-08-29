<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;


/**
 * Digital signature service
 */
class DigiDocService extends \Bigbank\DigiDoc\Soap\ProxyAwareClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = [
        'DataFileAttribute'        => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\DataFileAttribute',
        'DataFileInfo'             => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\DataFileInfo',
        'SignerRole'               => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\SignerRole',
        'SignatureProductionPlace' => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\SignatureProductionPlace',
        'CertificatePolicy'        => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\CertificatePolicy',
        'CertificateInfo'          => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\CertificateInfo',
        'SignerInfo'               => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\SignerInfo',
        'ConfirmationInfo'         => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\ConfirmationInfo',
        'TstInfo'                  => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\TstInfo',
        'RevokedInfo'              => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\RevokedInfo',
        'CRLInfo'                  => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\CRLInfo',
        'Error'                    => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\Error',
        'SignatureInfo'            => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\SignatureInfo',
        'SignedDocInfo'            => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\SignedDocInfo',
        'DataFileData'             => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\DataFileData',
        'SignatureModule'          => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\SignatureModule',
        'SignatureModulesArray'    => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\SignatureModulesArray',
        'DataFileDigest'           => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\DataFileDigest',
        'DataFileDigestList'       => 'Bigbank\\DigiDoc\\Soap\\Wsdl\\DataFileDigestList',
    ];

    /**
     * @param array  $options A array of config values
     * @param string $wsdl    The wsdl file to use
     */
    public function __construct(array $options = [], $wsdl = 'https://tsp.demo.sk.ee?wsdl')
    {

        foreach (self::$classmap as $key => $value) {
            if (!isset($options['classmap'][$key])) {
                $options['classmap'][$key] = $value;
            }
        }
        $options = array_merge([
            'features'   => SOAP_SINGLE_ELEMENT_ARRAYS,
        ], $options);
        parent::__construct($wsdl, $options);
    }

    /**
     * Service definition of function d__StartSession
     *
     * @param string       $SigningProfile
     * @param string       $SigDocXML
     * @param boolean      $bHoldSession
     * @param DataFileData $datafile
     *
     * @return list(string $Status, int $Sesscode, SignedDocInfo $SignedDocInfo)
     */
    public function StartSession($SigningProfile, $SigDocXML, $bHoldSession, DataFileData $datafile = null)
    {

        return $this->__soapCall('StartSession', [$SigningProfile, $SigDocXML, $bHoldSession, $datafile]);
    }

    /**
     * Service definition of function d__CloseSession
     *
     * @param int $Sesscode
     *
     * @return string
     */
    public function CloseSession($Sesscode)
    {

        return $this->__soapCall('CloseSession', [$Sesscode]);
    }

    /**
     * Service definition of function d__CreateSignedDoc
     *
     * @param int    $Sesscode
     * @param string $Format
     * @param string $Version
     *
     * @return list(string $Status, SignedDocInfo $SignedDocInfo)
     */
    public function CreateSignedDoc($Sesscode, $Format, $Version)
    {

        return $this->__soapCall('CreateSignedDoc', [$Sesscode, $Format, $Version]);
    }

    /**
     * Service definition of function d__AddDataFile
     *
     * @param int    $Sesscode
     * @param string $FileName
     * @param string $MimeType
     * @param string $ContentType
     * @param int    $Size
     * @param string $DigestType
     * @param string $DigestValue
     * @param string $Content
     *
     * @return list(string $Status, SignedDocInfo $SignedDocInfo)
     */
    public function AddDataFile(
        $Sesscode,
        $FileName,
        $MimeType,
        $ContentType,
        $Size,
        $DigestType,
        $DigestValue,
        $Content
    ) {

        return $this->__soapCall('AddDataFile',
            [$Sesscode, $FileName, $MimeType, $ContentType, $Size, $DigestType, $DigestValue, $Content]);
    }

    /**
     * Service definition of function d__RemoveDataFile
     *
     * @param int    $Sesscode
     * @param string $DataFileId
     *
     * @return list(string $Status, SignedDocInfo $SignedDocInfo)
     */
    public function RemoveDataFile($Sesscode, $DataFileId)
    {

        return $this->__soapCall('RemoveDataFile', [$Sesscode, $DataFileId]);
    }

    /**
     * Service definition of function d__GetSignedDoc
     *
     * @param int $Sesscode
     *
     * @return list(string $Status, string $SignedDocData)
     */
    public function GetSignedDoc($Sesscode)
    {

        return $this->__soapCall('GetSignedDoc', [$Sesscode]);
    }

    /**
     * Service definition of function d__GetSignedDocInfo
     *
     * @param int $Sesscode
     *
     * @return list(string $Status, SignedDocInfo $SignedDocInfo)
     */
    public function GetSignedDocInfo($Sesscode)
    {

        return $this->__soapCall('GetSignedDocInfo', [$Sesscode]);
    }

    /**
     * Service definition of function d__GetDataFile
     *
     * @param int    $Sesscode
     * @param string $DataFileId
     *
     * @return list(string $Status, DataFileData $DataFileData)
     */
    public function GetDataFile($Sesscode, $DataFileId)
    {

        return $this->__soapCall('GetDataFile', [$Sesscode, $DataFileId]);
    }

    /**
     * Service definition of function d__GetSignersCertificate
     *
     * @param int    $Sesscode
     * @param string $SignatureId
     *
     * @return list(string $Status, string $CertificateData)
     */
    public function GetSignersCertificate($Sesscode, $SignatureId)
    {

        return $this->__soapCall('GetSignersCertificate', [$Sesscode, $SignatureId]);
    }

    /**
     * Service definition of function d__GetNotarysCertificate
     *
     * @param int    $Sesscode
     * @param string $SignatureId
     *
     * @return list(string $Status, string $CertificateData)
     */
    public function GetNotarysCertificate($Sesscode, $SignatureId)
    {

        return $this->__soapCall('GetNotarysCertificate', [$Sesscode, $SignatureId]);
    }

    /**
     * Service definition of function d__GetNotary
     *
     * @param int    $Sesscode
     * @param string $SignatureId
     *
     * @return list(string $Status, string $OcspData)
     */
    public function GetNotary($Sesscode, $SignatureId)
    {

        return $this->__soapCall('GetNotary', [$Sesscode, $SignatureId]);
    }

    /**
     * Service definition of function d__GetTSACertificate
     *
     * @param int    $Sesscode
     * @param string $TimestampId
     *
     * @return list(string $Status, string $CertificateData)
     */
    public function GetTSACertificate($Sesscode, $TimestampId)
    {

        return $this->__soapCall('GetTSACertificate', [$Sesscode, $TimestampId]);
    }

    /**
     * Service definition of function d__GetTimestamp
     *
     * @param int    $Sesscode
     * @param string $TimestampId
     *
     * @return list(string $Status, string $TimestampData)
     */
    public function GetTimestamp($Sesscode, $TimestampId)
    {

        return $this->__soapCall('GetTimestamp', [$Sesscode, $TimestampId]);
    }

    /**
     * Service definition of function d__GetCRL
     *
     * @param int    $Sesscode
     * @param string $SignatureId
     *
     * @return list(string $Status, string $CRLData)
     */
    public function GetCRL($Sesscode, $SignatureId)
    {

        return $this->__soapCall('GetCRL', [$Sesscode, $SignatureId]);
    }

    /**
     * Service definition of function d__PrepareSignature
     *
     * @param int    $Sesscode
     * @param string $SignersCertificate
     * @param string $SignersTokenId
     * @param string $Role
     * @param string $City
     * @param string $State
     * @param string $PostalCode
     * @param string $Country
     * @param string $SigningProfile
     *
     * @return list(string $Status, string $SignatureId, string $SignedInfoDigest)
     */
    public function PrepareSignature(
        $Sesscode,
        $SignersCertificate,
        $SignersTokenId,
        $Role,
        $City,
        $State,
        $PostalCode,
        $Country,
        $SigningProfile
    ) {

        return $this->__soapCall('PrepareSignature', [
            $Sesscode,
            $SignersCertificate,
            $SignersTokenId,
            $Role,
            $City,
            $State,
            $PostalCode,
            $Country,
            $SigningProfile
        ]);
    }

    /**
     * Service definition of function d__FinalizeSignature
     *
     * @param int    $Sesscode
     * @param string $SignatureId
     * @param string $SignatureValue
     *
     * @return list(string $Status, SignedDocInfo $SignedDocInfo)
     */
    public function FinalizeSignature($Sesscode, $SignatureId, $SignatureValue)
    {

        return $this->__soapCall('FinalizeSignature', [$Sesscode, $SignatureId, $SignatureValue]);
    }

    /**
     * Service definition of function d__RemoveSignature
     *
     * @param int    $Sesscode
     * @param string $SignatureId
     *
     * @return list(string $Status, SignedDocInfo $SignedDocInfo)
     */
    public function RemoveSignature($Sesscode, $SignatureId)
    {

        return $this->__soapCall('RemoveSignature', [$Sesscode, $SignatureId]);
    }

    /**
     * Service definition of function d__GetVersion
     *
     * @return list(string $Name, string $Version, string $Libname, string $Libver)
     */
    public function GetVersion()
    {

        return $this->__soapCall('GetVersion', []);
    }

    /**
     * Service definition of function d__MobileSign
     *
     * @param int     $Sesscode
     * @param string  $SignerIDCode
     * @param string  $SignersCountry
     * @param string  $SignerPhoneNo
     * @param string  $ServiceName
     * @param string  $AdditionalDataToBeDisplayed
     * @param string  $Language
     * @param string  $Role
     * @param string  $City
     * @param string  $StateOrProvince
     * @param string  $PostalCode
     * @param string  $CountryName
     * @param string  $SigningProfile
     * @param string  $MessagingMode
     * @param int     $AsyncConfiguration
     * @param boolean $ReturnDocInfo
     * @param boolean $ReturnDocData
     *
     * @return list(string $Status, string $StatusCode, string $ChallengeID)
     */
    public function MobileSign(
        $Sesscode,
        $SignerIDCode,
        $SignersCountry,
        $SignerPhoneNo,
        $ServiceName,
        $AdditionalDataToBeDisplayed,
        $Language,
        $Role,
        $City,
        $StateOrProvince,
        $PostalCode,
        $CountryName,
        $SigningProfile,
        $MessagingMode,
        $AsyncConfiguration,
        $ReturnDocInfo,
        $ReturnDocData
    ) {

        return $this->__soapCall('MobileSign', [
            $Sesscode,
            $SignerIDCode,
            $SignersCountry,
            $SignerPhoneNo,
            $ServiceName,
            $AdditionalDataToBeDisplayed,
            $Language,
            $Role,
            $City,
            $StateOrProvince,
            $PostalCode,
            $CountryName,
            $SigningProfile,
            $MessagingMode,
            $AsyncConfiguration,
            $ReturnDocInfo,
            $ReturnDocData
        ]);
    }

    /**
     * Service definition of function d__GetStatusInfo
     *
     * @param int     $Sesscode
     * @param boolean $ReturnDocInfo
     * @param boolean $WaitSignature
     *
     * @return list(string $Status, string $StatusCode, SignedDocInfo $SignedDocInfo)
     */
    public function GetStatusInfo($Sesscode, $ReturnDocInfo, $WaitSignature)
    {

        return $this->__soapCall('GetStatusInfo', [$Sesscode, $ReturnDocInfo, $WaitSignature]);
    }

    /**
     * Service definition of function d__MobileAuthenticate
     *
     * @param string  $IDCode
     * @param string  $CountryCode
     * @param string  $PhoneNo
     * @param string  $Language
     * @param string  $ServiceName
     * @param string  $MessageToDisplay
     * @param string  $SPChallenge
     * @param string  $MessagingMode
     * @param int     $AsyncConfiguration
     * @param boolean $ReturnCertData
     * @param boolean $ReturnRevocationData
     *
     * @return list(int $Sesscode, string $Status, string $UserIDCode, string $UserGivenname, string $UserSurname, string $UserCountry, string $UserCN, string $CertificateData, string $ChallengeID, string $Challenge, string $RevocationData)
     */
    public function MobileAuthenticate(
        $IDCode,
        $CountryCode,
        $PhoneNo,
        $Language,
        $ServiceName,
        $MessageToDisplay,
        $SPChallenge,
        $MessagingMode,
        $AsyncConfiguration,
        $ReturnCertData,
        $ReturnRevocationData
    ) {

        return $this->__soapCall('MobileAuthenticate', [
            $IDCode,
            $CountryCode,
            $PhoneNo,
            $Language,
            $ServiceName,
            $MessageToDisplay,
            $SPChallenge,
            $MessagingMode,
            $AsyncConfiguration,
            $ReturnCertData,
            $ReturnRevocationData
        ]);
    }

    /**
     * Service definition of function d__GetMobileAuthenticateStatus
     *
     * @param int     $Sesscode
     * @param boolean $WaitSignature
     *
     * @return list(string $Status, string $Signature)
     */
    public function GetMobileAuthenticateStatus($Sesscode, $WaitSignature)
    {

        return $this->__soapCall('GetMobileAuthenticateStatus', [$Sesscode, $WaitSignature]);
    }

    /**
     * Service definition of function d__MobileCreateSignature
     *
     * @param string             $IDCode
     * @param string             $SignersCountry
     * @param string             $PhoneNo
     * @param string             $Language
     * @param string             $ServiceName
     * @param string             $MessageToDisplay
     * @param string             $Role
     * @param string             $City
     * @param string             $StateOrProvince
     * @param string             $PostalCode
     * @param string             $CountryName
     * @param string             $SigningProfile
     * @param DataFileDigestList $DataFiles
     * @param string             $Format
     * @param string             $Version
     * @param string             $SignatureID
     * @param string             $MessagingMode
     * @param int                $AsyncConfiguration
     *
     * @return list(int $Sesscode, string $ChallengeID, string $Status)
     */
    public function MobileCreateSignature(
        $IDCode,
        $SignersCountry,
        $PhoneNo,
        $Language,
        $ServiceName,
        $MessageToDisplay,
        $Role,
        $City,
        $StateOrProvince,
        $PostalCode,
        $CountryName,
        $SigningProfile,
        DataFileDigestList $DataFiles,
        $Format,
        $Version,
        $SignatureID,
        $MessagingMode,
        $AsyncConfiguration
    ) {

        return $this->__soapCall('MobileCreateSignature', [
            $IDCode,
            $SignersCountry,
            $PhoneNo,
            $Language,
            $ServiceName,
            $MessageToDisplay,
            $Role,
            $City,
            $StateOrProvince,
            $PostalCode,
            $CountryName,
            $SigningProfile,
            $DataFiles,
            $Format,
            $Version,
            $SignatureID,
            $MessagingMode,
            $AsyncConfiguration
        ]);
    }

    /**
     * Service definition of function d__GetMobileCreateSignatureStatus
     *
     * @param int     $Sesscode
     * @param boolean $WaitSignature
     *
     * @return list(int $Sesscode, string $Status, string $Signature)
     */
    public function GetMobileCreateSignatureStatus($Sesscode, $WaitSignature)
    {

        return $this->__soapCall('GetMobileCreateSignatureStatus', [$Sesscode, $WaitSignature]);
    }

    /**
     * Service definition of function d__GetMobileCertificate
     *
     * @param string $IDCode
     * @param string $Country
     * @param string $PhoneNo
     * @param string $ReturnCertData
     *
     * @return list(string $AuthCertStatus, string $SignCertStatus, string $AuthCertData, string $SignCertData)
     */
    public function GetMobileCertificate($IDCode, $Country, $PhoneNo, $ReturnCertData)
    {

        return $this->__soapCall('GetMobileCertificate', [$IDCode, $Country, $PhoneNo, $ReturnCertData]);
    }

    /**
     * Service definition of function d__CheckCertificate
     *
     * @param string  $Certificate
     * @param boolean $ReturnRevocationData
     *
     * @return list(string $Status, string $UserIDCode, string $UserGivenname, string $UserSurname, string $UserCountry, string $UserOrganisation, string $UserCN, string $IssuerCN, string $KeyUsage, string $EnhancedKeyUsage, string $RevocationData)
     */
    public function CheckCertificate($Certificate, $ReturnRevocationData)
    {

        return $this->__soapCall('CheckCertificate', [$Certificate, $ReturnRevocationData]);
    }

}
