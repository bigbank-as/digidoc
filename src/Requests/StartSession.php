<?php
namespace Bigbank\MobileId\Requests;

/**
 * Start the two-step mobile ID signing process by sending a file
 */
class StartSession extends AbstractRequest
{

    /**
     * {@inheritdoc}
     */
    public function getDefaultArguments()
    {

        return [
            'datafile' => null
        ];
    }
}
