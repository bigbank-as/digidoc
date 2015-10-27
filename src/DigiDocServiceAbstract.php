<?php
namespace Bigbank\MobileId;

/**
 * {@inheritdoc}
 */
class DigiDocServiceAbstract implements DigiDocServiceInterface
{

    /**
     * @var string
     */
    const URL_PRODUCTION = 'https://digidocservice.sk.ee/?wsdl';

    /**
     * @var string
     */
    const URL_TEST = 'https://tsp.demo.sk.ee?WSDL';

    /**
     * @var string
     */
    protected $apiUrl = self::URL_TEST;

    /**
     * @var array
     */
    protected $options = [
        'exceptions' => true,
        'proxy_host' => null,
        'proxy_port' => null
    ];

    /**
     * {@inheritdoc}
     */
    public function setOptions(array $options)
    {

        $this->options = array_replace($this->options, $options);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiUrl($apiUrl)
    {

        $this->apiUrl = $apiUrl;
        return $this;
    }
}
