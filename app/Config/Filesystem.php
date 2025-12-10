<?php

namespace Config;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;

class Filesystem
{
    public function __construct()
    {
        $key = getenv('AWS_ACCESS_KEY_ID');
        $secret = getenv('AWS_SECRET_ACCESS_KEY');
        $region = getenv('AWS_REGION') ?: 'us-east-1';

        if (!$key || !$secret) {
            throw new \Exception('AWS credentials not set. Please configure AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY.');
        }

        // Configuración de AWS S3
        $this->s3Client = new S3Client([
            'region' => $region,
            'version' => 'latest',
            'credentials' => [
                'key' => $key,
                'secret' => $secret,
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