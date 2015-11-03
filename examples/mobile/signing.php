<?php

use Bigbank\DigiDoc\DigiDoc;
use Bigbank\DigiDoc\Services\MobileId\FileSigner;

include '../../vendor/autoload.php';

$digiDocService = new DigiDoc(DigiDoc::URL_TEST);

/** @var FileSigner $sign */
$sign = $digiDocService->getService(FileSigner::class);

$userPhone   = '+37200007';
$userIdCode  = '14212128025';
$fileContent = base64_encode(file_get_contents('base64.example.pdf'));
$fileSize    = filesize('base64.example.pdf');

echo sprintf("Trying to sign a document with ID code %s, phone %s...\n", $userIdCode, $userPhone);

$sign->startSession();

echo sprintf("Adding file...\n\n\n");

    $sign->addFile('contract.pdf', 'application/pdf', $fileContent, $fileSize);

echo sprintf("Signing...\n\n\n");

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

