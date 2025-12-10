<?php

namespace Config;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;

class Filesystem
{
    public function __construct()
    {
        // Configuración de AWS S3
        $this->s3Client = new S3Client([
            'region' => getenv('AWS_REGION') ?: 'us-east-1',
            'version' => 'latest',
            'credentials' => [
                'key' => getenv('AWS_ACCESS_KEY_ID'),
                'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $this->adapter = new AwsS3V3Adapter(
            $this->s3Client,
            getenv('AWS_S3_BUCKET') ?: 'brixo-images'
        );

        $this->filesystem = new Filesystem($this->adapter);
    }

    public function getFilesystem()
    {
        return $this->filesystem;
    }

    public function uploadImage($filePath, $fileName)
    {
        $stream = fopen($filePath, 'r+');
        $this->filesystem->writeStream($fileName, $stream);
        fclose($stream);
        return $this->getPublicUrl($fileName);
    }

    public function getPublicUrl($fileName)
    {
        // Asumiendo que el bucket es público o tienes CloudFront
        return 'https://' . (getenv('AWS_S3_BUCKET') ?: 'brixo-images') . '.s3.amazonaws.com/' . $fileName;
    }
}