<?php
namespace Bigbank\DigiDoc\Soap;

use Bigbank\DigiDoc\Soap\Wsdl\DataFileData;

interface DigiDocServiceInterface
{

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
    );

    /**
     * Service definition of function d__GetMobileAuthenticateStatus
     *
     * @param int     $Sesscode
     * @param boolean $WaitSignature
     *
     * @return list(string $Status, string $Signature)
     */
    public function GetMobileAuthenticateStatus($Sesscode, $WaitSignature);

    /**
     * Service definition of function d__StartSession
     *
     * @param string       $SigningProfile
     * @param string       $SigDocXML
     * @param bool         $bHoldSession
     * @param DataFileData $datafile
     *
     * @return list(string $Status, int $Sesscode, SignedDocInfo $SignedDocInfo)
     */
    public function StartSession($SigningProfile, $SigDocXML, $bHoldSession, DataFileData $datafile);

    /**
     * Service definition of function d__CreateSignedDoc
     *
     * @param int    $Sesscode
     * @param string $Format
     * @param string $Version
     *
     * @return list(string $Status, string $SignedDocInfo)
     */
    public function CreateSignedDoc($Sesscode, $Format, $Version);

    /**
     * @param int    $Sesscode
     * @param string $Filename
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
        $Filename,
        $MimeType,
        $ContentType,
        $Size,
        $DigestType,
        $DigestValue,
        $Content
    );

    /**
     * @param int    $Sesscode
     * @param string $SignerIDCode
     * @param string $SignersCountry
     * @param string $SignerPhoneNo
     * @param string $ServiceName
     * @param string $AdditionalDataToBeDisplayed
     * @param string $Language
     * @param string $Role
     * @param string $City
     * @param string $StateOrProvince
     * @param string $PostalCode
     * @param string $CountryName
     * @param string $SigningProfile
     * @param string $MessagingMode
     * @param int    $AsyncConfiguration
     * @param bool   $ReturnDocInfo
     * @param bool   $ReturnDocData
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
    );

    /**
     * @param int  $Sesscode
     * @param bool $ReturnDocInfo
     * @param bool $WaitSignature
     *
     * @return list(string $Status, string $StatusCode, SignedDocInfo $SignedDocInfo)
     */
    public function GetStatusInfo($Sesscode, $ReturnDocInfo, $WaitSignature);

    /**
     * @param int $Sesscode
     *
     * @return list(string $Status, SignedDocInfo $SignedDocInfo)
     */
    public function GetSignedDoc($Sesscode);

    /**
     * Service definition of function d__CloseSession
     *
     * @param int $Sesscode
     *
     * @return string
     */
    public function CloseSession($Sesscode);
}
