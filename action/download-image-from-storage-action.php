<?php
    require '../vendor/autoload.php';
    require '../configuration/blob-storage-configuration.php';
    require '../helper/blob-storage-helper.php';
    require '../controller/ImageController.php';

    $imageController = new ImageController($blobClient);

    $response = [];
    if(isset($_GET['name']))
    {
        $containerName = $_GET['name'];

        $imageBytes = $imageController->get($containerName);
        $fp = fopen('../public/images/' . $containerName, "w");
        fwrite($fp, $imageBytes);
        fclose($fp);
        $response['image'] = '/public/images/'.$containerName;
    }
    else
    {
        $response['message'] = 'Invalid Request';
    }

    echo json_encode($response);