<?php
namespace Bigbank\MobileId\Request;

/**
 *
 */
class CreateSignedDoc extends AbstractRequest
{

    /**
     * {@inheritdoc}
     */
    public function getDefaultArguments()
    {

        return [
            'Sesscode' => '',
            'Format'   => 'BDOC',
            'Version'  => '2.1'
        ];
    }
}
