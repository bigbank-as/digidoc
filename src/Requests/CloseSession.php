<?php
namespace Bigbank\DigiDoc\Requests;

/**
 * Terminates and clears the session
 */
class CloseSession extends AbstractRequest
{

    /**
     * {@inheritdoc}
     */
    public function getDefaultArguments()
    {

        return [
            'Sesscode' => null
        ];
    }
}
