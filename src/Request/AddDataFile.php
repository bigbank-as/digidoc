<?php
namespace Bigbank\MobileId\Request;

/**
 * Send file for signing
 */
class AddDataFile extends AbstractRequest
{

    /**
     * {@inheritdoc}
     */
    public function getDefaultArguments()
    {

        return [
            'Sesscode'    => '',
            'Filename'    => '',
            'MimeType'    => '',
            'ContentType' => 'EMBEDDED_BASE64',
            'Size'        => '',
            'DigestType'  => '',
            'DigestValue' => '',
            'Content'     => ''
        ];
    }
}
