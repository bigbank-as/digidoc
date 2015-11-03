<?php
namespace Bigbank\DigiDoc\Services;

use Bigbank\DigiDoc\Soap\DigiDocServiceInterface;

/**
 * {@inheritdoc}
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
