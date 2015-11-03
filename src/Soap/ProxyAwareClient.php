<?php
namespace Bigbank\DigiDoc\Soap;

use Bigbank\DigiDoc\Exceptions\DigiDocException;

/**
 * A SOAP client that handles HTTP(S) proxy correctly
 */
class ProxyAwareClient extends \SoapClient implements SoapClientInterface
{

    /**
     * @var array
     */
    protected $options = [
        'exceptions' => true,
        'proxy_host' => null,
        'proxy_port' => null
    ];

    /**
     * @param string $request
     * @param string $location
     * @param string $action
     * @param int    $version
     * @param int    $one_way
     *
     * @return string
     */
    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {

        return $this->callCurl($location, $request, $action);
    }

    /**
     * @param string $url
     * @param string $data
     * @param string $action
     *
     * @return string
     */
    protected function callCurl($url, $data, $action)
    {

        $handle = curl_init();

        $headers = ["Content-Type: text/xml", 'SOAPAction: "' . $action . '"'];

        curl_setopt_array($handle, [
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_PROXY          => $this->getProxyString()
        ]);

        $response = curl_exec($handle);
        curl_close($handle);

        return $response;
    }

    /**
     * @return bool|string
     */
    protected function getProxyString()
    {

        if (empty($this->_proxy_host) || empty($this->_proxy_port)) {
            return false;
        }
        return sprintf('%s:%d', $this->_proxy_host, $this->_proxy_port);
    }

    /**
     * @param string     $function_name
     * @param array      $arguments
     * @param array|null $options
     * @param null       $input_headers
     * @param array|null $output_headers
     *
     * @return array
     * @throws DigiDocException
     */
    public function __soapCall(
        $function_name,
        $arguments,
        $options = null,
        $input_headers = null,
        &$output_headers = null
    ) {

        try {
            return parent::__soapCall($function_name, $arguments, $options, $input_headers, $output_headers);
        } catch (\SoapFault $fault) {
            throw new DigiDocException(
                $fault->detail->message,
                (int)$fault->faultstring
            );
        }
    }
}
