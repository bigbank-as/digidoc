<?php
include 'vendor/autoload.php';

$auth = new \Bigbank\MobileId\Authenticator(
    'https://tsp.demo.sk.ee?WSDL', [
    'proxy_host' => 'cache.big.local',
    'proxy_port' => 3128
]);

$input = new \Bigbank\MobileId\Dto\AuthenticationInput;
$input->setPhoneNumber('+37200007')
    ->setServiceName('Testimine');

$response = $auth->authenticate($input);

$input = new \Bigbank\MobileId\Dto\StatusInput;
$input->setSessionId($response['Sesscode']);
$status = $auth->askStatus($input);

exit;
