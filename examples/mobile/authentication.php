<?php
use Bigbank\DigiDoc\DigiDoc;
use Bigbank\DigiDoc\Services\MobileId\AuthenticatorInterface;
use Bigbank\DigiDoc\Soap\InteractionStatus;

include './vendor/autoload.php';

// Instantiate the main class - use DigiDoc testing API
$digiDocService = new DigiDoc(DigiDoc::URL_TEST);

// Ask for the authentication service
/** @var AuthenticatorInterface $authenticator */
$authenticator = $digiDocService->getService(AuthenticatorInterface::class);

printf("Trying to authenticate with mobile ID (using testing API)...\n");

// Make an authentication request to SK using testing inputs (see http://www.id.ee/?id=36373)
$response = $authenticator->authenticate('14212128025', '+37200007', 'Testimine', 'My Application');

print_r($response);

// The testing service simulates a delay while the imaginary "user" confirms authentication with his/her phone
printf(
    "Authentication code (%d) sent to %s, waiting for confirmation (< 4min)...\n\n",
    $response['ChallengeID'],
    $response['UserCN']
);

// Wait for the user to respond to the authentication.
// This will either end with a success, failure or a timeout (~4min).
// If a blocking call is not desired, use the `askStatus` function to poll.
echo $authenticator->waitForAuthentication(function ($status) {

    if ($status === InteractionStatus::USER_AUTHENTICATED) {
        return "\nAuthentication OK\n";
    }

    return sprintf("\nFailure. Status was %s.\n", $status);
});
