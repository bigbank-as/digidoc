<?php
include 'vendor/autoload.php';

$auth = new \Bigbank\MobileId\Authenticator;
$auth->setOptions([
    'proxy_host' => 'cache.big.local',
    'proxy_port' => 3128
]);

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

} catch (\Bigbank\MobileId\IdException $e) {
    die(sprintf(
        'sk.ee service responded with an error of code %d. The message was: %s',
        $e->getCode(),
        $e->getMessage()
    ));
}


exit;
