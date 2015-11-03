<?php
use Bigbank\DigiDoc\DigiDoc;
use Bigbank\DigiDoc\Services\MobileId\Authenticator;

include '../../vendor/autoload.php';

$digiDocService = new DigiDoc(DigiDoc::URL_TEST);

/** @var Authenticator $authenticator */
$authenticator = $digiDocService->getService(Authenticator::class);

echo sprintf("Trying to authenticate...\n");
$response = $authenticator->authenticate('14212128025', '+37200007', 'Testimine', 'White House');

echo sprintf(
    "Authentication code sent to %s %s, waiting for confirmation (< 4min)...\n\n",
    $response['UserGivenname'],
    $response['UserSurname']
);

$callback = function ($status) {

    if ($status == 'USER_AUTHENTICATED') {
        return "\nAuthentication OK\n";
    }

    return 'Failure. Status was ' . $status;
};

$message = $authenticator->waitForAuthentication($response['Sesscode'], $callback);

echo $message;
