<?php


class ImageController
{
    private $blobClient;

    public function __construct($blobClient)
    {
        $this->blobClient = $blobClient;
    }

    function upload($request, $containerName)
    {
        $content = fopen($request['tmp_name'], "r");
        $this->blobClient->createBlockBlob($containerName, $containerName, $content);
    }

    function get($containerName)
    {
        ob_start();
        $blob = $this->blobClient->getBlob($containerName, $containerName);
        fpassthru($blob->getContentStream());
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}