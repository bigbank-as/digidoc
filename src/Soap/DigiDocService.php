<?php

namespace Bigbank\DigiDoc\Soap;

interface DigiDocService
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
}
