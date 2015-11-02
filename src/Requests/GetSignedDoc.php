<?php
namespace Bigbank\DigiDoc\Requests;

/**
 * Returns the signed document
 */
class GetSignedDoc extends AbstractRequest
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
