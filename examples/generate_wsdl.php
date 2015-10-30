<?php
use Bigbank\DigiDoc\DigiDoc;
use Wsdl2PhpGenerator\Config;
use Wsdl2PhpGenerator\Generator;

require '../vendor/autoload.php';

$generator = new Generator;
$config    = new Config([
    'inputFile'       => DigiDoc::URL_TEST,
    'outputDir'       => '../src/Soap/Wsdl',
    'namespaceName'   => 'Bigbank\DigiDoc\Soap\Wsdl',
    'proxy'           => getenv('HTTPS_PROXY'),
    'sharedTypes'     => true,
    // 'soapClientClass' value must begin with a leading namespace class
    // otherwise the generated class uses a relative namespace which won't resolve
    'soapClientClass' => '\Bigbank\DigiDoc\Soap\ProxyAwareClient'
]);

$generator->generate($config);

// Delete autoloader - it's not needed as we use Composer's
if (file_exists('../src/Soap/Wsdl/autoload.php')) {
    unlink('../src/Soap/Wsdl/autoload.php');
}
