<?php

include __DIR__ . '/../../vendor/autoload.php';

use Bigbank\DigiDoc\DigiDoc;
use Bigbank\DigiDoc\Services\IdCard\FileSignerInterface;

// Instantiate the main class - use DigiDoc testing service
$digiDocService = new DigiDoc(DigiDoc::URL_TEST, ['cache_wsdl' => WSDL_CACHE_NONE]);

// Ask for the file signing service
/** @var FileSignerInterface $signer */
$signer = $digiDocService->getService(FileSignerInterface::class);


/**
 * 2. Finalize the signature from browser and store it in SK
 */
$signer->setSessionCode($_POST['session']);
$data = $signer->finalizeSignature($_POST['signature_id'], $_POST['signature']);
$signer->waitForSignature(function($status, $fileContent) use ($signer) {
    $content = base64_decode($fileContent);
    file_put_contents('testfile.bdoc', $content);
    $signer->closeSession();
});
header('Content-Type: application/json');
print json_encode($data);

