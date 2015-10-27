<?php
namespace Bigbank\MobileId\Request;

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
