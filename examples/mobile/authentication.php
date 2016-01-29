<?php
use Bigbank\DigiDoc\DigiDoc;
use Bigbank\DigiDoc\Services\MobileId\AuthenticatorInterface;
use Bigbank\DigiDoc\Soap\InteractionStatus;

include './vendor/autoload.php';

$digiDocService = new DigiDoc(DigiDoc::URL_TEST);

/** @var AuthenticatorInterface $authenticator */
$authenticator = $digiDocService->getService(AuthenticatorInterface::class);

echo sprintf("Trying to authenticate...\n");
$response = $authenticator->authenticate('14212128025', '+37200007', 'Testimine', 'White House');

echo sprintf(
    "Authentication code sent to %s %s, waiting for confirmation (< 4min)...\n\n",
    $response['UserGivenname'],
    $response['UserSurname']
);

$callback = function ($status) {

    if ($status == InteractionStatus::USER_AUTHENTICATED) {
        return "\nAuthentication OK";
    }

    return 'Failure. Status was ' . $status;
};

$message = $authenticator->waitForAuthentication($response['Sesscode'], $callback);

echo $message;
