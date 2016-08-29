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
 * Here starts the ajax part.
 *
 * 1. Ask certificate from browser and store it in SK
 */
$signer->setSessionCode($_POST['session']);
$data = $prepareSignatureResponse = $signer->prepareSignature($_POST['certificate']);
header('Content-Type: application/json');
print json_encode($data);
