<?php

use Bigbank\DigiDoc\DigiDoc;
use Bigbank\DigiDoc\Services\MobileId\FileSignerInterface;
use Bigbank\DigiDoc\Soap\InteractionStatus;

include './vendor/autoload.php';

// Instantiate the main class - use DigiDoc testing service
$digiDocService = new DigiDoc(DigiDoc::URL_TEST);

// Ask for the file signing service
/** @var FileSignerInterface $signer */
$signer = $digiDocService->getService(FileSignerInterface::class);

// Inputs to the file signer
$userPhone   = '+37200007';
$userIdCode  = '14212128025';
$fileContent = base64_encode(file_get_contents(__DIR__ . '/example.document.pdf'));

printf("Trying to sign a document on behalf of person %s, phone %s...\n", $userIdCode, $userPhone);

// Create a new "empty" container in SK-s service
$signer->startSession();

printf("Uploading the file...\n");
$signer->addFile('document.pdf', 'application/pdf', $fileContent);

printf("Signing...\n");
$response = $signer->sign($userIdCode, $userPhone, 'Testimine', 'My Application');

printf(
    "Challenge ID %s is sent, waiting for a signature...\n",
    $response['ChallengeID']
);

// Wait for the user to sign the document.
// This is a blocking call which will end with either success, failure or a timeout
// The callback function receives the status of the signing and the signed file (if successful) as a base64 string.
// If a blocking call is not desired, use `askStatus` to poll.
$signer->waitForSignature(function ($status, $fileContent) {

    // The signing might have failed (user cancelled, timeout...)
    if ($status !== InteractionStatus::SIGNATURE) {
        printf('Signing failed with status %s', $status);
        die();
    }

    // You'd normally want to save the base64-decoded content of the result (a .bdoc signed file)
    // to your file system. For the purposes of this demo we'll just echo it's size.
    $fileSize = mb_strlen(base64_decode($fileContent), '8bit') / 1024;

    printf("Signature created. The size of the signed .bdoc file is %dkB.\n", $fileSize);
});

// Destroy any data (files) about our session from the remote SK server
$signer->closeSession();
