<?php
    use MicrosoftAzure\Storage\Blob\BlobRestProxy;
    use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
    use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

    $connectionString = "DefaultEndpointsProtocol=https;AccountName=".$blobConfig['account_name'].";AccountKey=".$blobConfig['account_key'].";EndpointSuffix=core.windows.net";
    $blobClient = BlobRestProxy::createBlobService($connectionString);

    $createContainerConfigurations = new CreateContainerOptions();
    $createContainerConfigurations->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

    $containerName = bin2hex(random_bytes(16));

    $blobClient->createContainer($containerName, $createContainerConfigurations);