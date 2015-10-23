<?php
namespace Bigbank\MobileId;


use Bigbank\MobileId\Dto\AuthenticationInput;
use Bigbank\MobileId\Dto\StatusInput;

class Authenticator extends AbstractRequest implements AuthenticatorInterface
{

    public function authenticate(array $input)
    {

        $client   = $this->clientFactory();

        $defaults = [
            'IDCode'
        ];

        $response = $client->MobileAuthenticate(
            $input->getIdCode(),
            $input->getCountryCode(),
            $input->getPhoneNumber(),
            $input->getLanguage(),
            $input->getServiceName(),
            $input->getMessageToDisplay(),
            $input->getChallengeToken(),
            $input->getMessagingMode(),
            $input->getAsyncConfiguration(),
            $input->getReturnCertData(),
            $input->getReturnRevocationData()
        );

        return $response;
    }

    public function askStatus(StatusInput $input)
    {

        $client = $this->clientFactory();
        $response = $client->GetMobileAuthenticateStatus($input->getSessionId());

        return $response;
    }

}
