<?php

include 'vendor/autoload.php';

$sign = new \Bigbank\MobileId\FileSigner;
$sign->setOptions([
    'proxy_host' => 'cache.big.local',
    'proxy_port' => 3128
]);

$userPhone  = '+37200007';
$userIdCode = '14212128025';
$fileData   = [
    'fileName'    => 'contract.pdf',
    'fileType'    => 'application/pdf',
    'fileContent' => file_get_contents('base64.example.txt')
];

try {
    echo sprintf("Trying to sign a document with ID code %s, phone %s...\n", $userIdCode, $userPhone);

    $sign->startSession();

    echo 'Adding file...' . "\n\n\n";

    $sign->addFile($fileData['fileName'], $fileData['fileType'], $fileData['fileContent']);

    echo 'Signing...' . "\n\n\n";

    $response = $sign->sign($userIdCode, $userPhone, 'Testimine', 'Message');

    echo sprintf(
        "Challenge ID %s is sent, waiting for a signature...\n\n",
        $response['ChallengeID']
    );

    for ($i = 0; $i < 40; $i++) {

        $status = $sign->getStatus($response['Sesscode']);

        if ($status['StatusCode'] === 'SIGNATURE') {
            echo '-----FILE-----' . "\n\n\n";

            echo $status['SignedDocData'];

            echo "\n\n\n" . '------EOF-----';

            die();
        }

        echo '.';
        sleep(4);
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
