<?php

use Bigbank\DigiDoc\DigiDoc;
use Bigbank\DigiDoc\Services\MobileId\FileSigner;

include '../../vendor/autoload.php';

$digiDocService = new DigiDoc(DigiDoc::URL_TEST);

/** @var FileSigner $signer */
$signer = $digiDocService->getService(FileSigner::class);

$userPhone   = '+37200007';
$userIdCode  = '14212128025';
$fileContent = base64_encode(file_get_contents('example.document.pdf'));

echo sprintf("Trying to sign a document with ID code %s, phone %s...\n", $userIdCode, $userPhone);

$signer->startSession();

echo sprintf("Adding file...\n\n\n");

$signer->addFile('document.pdf', 'application/pdf', $fileContent);

echo sprintf("Signing...\n\n\n");

$response = $signer->sign($userIdCode, $userPhone, 'Testimine', 'My Application');

echo sprintf(
    "Challenge ID %s is sent, waiting for a signature...\n\n",
    $response['ChallengeID']
);

$callback = function ($status, $fileContents) {

    echo "\nSignature created\n";

    file_put_contents('signed.document.bdoc', base64_decode($fileContents));
    echo '----- FILE -----' . "\n\n\n";

    echo $fileContents;

    echo "\n\n\n" . '------ EOF -----';
};

$signer->waitForSignature($callback);

$signer->closeSession();
