<?php
use Bigbank\DigiDoc\Exceptions\IdException;
use Bigbank\DigiDoc\DigiDoc;
use Bigbank\DigiDoc\Services\MobileId\AuthenticatorInterface;

include '../vendor/autoload.php';

$mobileId = new DigiDoc(DigiDoc::URL_TEST);
$auth = $mobileId->getService(AuthenticatorInterface::class);

$userPhone  = '+37200007';
$userIdCode = '14212128025';

try {
    echo sprintf("Trying to authenticate person with ID code %s, phone %s...\n", $userIdCode, $userPhone);

    $response = $auth->authenticate($userIdCode, $userPhone, 'Testimine', 'Message');
    echo sprintf(
        "Authentication code sent to %s %s, waiting for confirmation...\n\n",
        $response['UserGivenname'],
        $response['UserSurname']
    );

    for ($i = 0; $i < 40; $i++) {
        $isAuthenticated = $auth->isAuthenticated($response['Sesscode']);

        if ($isAuthenticated) {
            die("\nSuccessfully authenticated.");
        }
        echo '.';
        sleep(1);
    }
    die('Failure: timed out.');

} catch (IdException $e) {
    die(sprintf(
        'sk.ee service responded with an error of code %d. The message was: %s',
        $e->getCode(),
        $e->getMessage()
    ));
}
