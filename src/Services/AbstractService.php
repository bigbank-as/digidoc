<?php
namespace Bigbank\DigiDoc\Services;

use Bigbank\DigiDoc\Soap\DigiDocServiceInterface;

/**
 * Common base class for DigiDoc service classes
 *
 * `DigiDocServiceInterface` combines all publicly available SOAP
 * methods and is needed by every service.
 */
abstract class AbstractService
{

    /**
     * @var DigiDocServiceInterface
     */
    protected $digiDocService;

    /**
     * @param DigiDocServiceInterface $digiDocService
     */
    public function __construct(DigiDocServiceInterface $digiDocService)
    {

        $this->digiDocService = $digiDocService;
    }
}
