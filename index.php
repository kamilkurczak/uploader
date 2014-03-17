<?php

$loader = require_once __DIR__.'/vendor/autoload.php';

use Tokk\Uploader\Uploader;
use Tokk\Uploader\Validator\SizeValidator;
use Tokk\Uploader\Validator\DimensionValidator;
use Tokk\Uploader\Callback\Resizer;

//set up uploader (without last "/")
$uploadRootDir = 'resources/uploader';
$uploader = new Uploader($uploadRootDir);

//base file upload to custom directory
$fileJPG = 'resources/1.jpg';

$uploader->addValidator(new SizeValidator(50, 2000000));
$uploader->addValidator(new DimensionValidator(100, 10000, 100, 10000));
$uploader->addCallback(new Resizer(0, 100));

if ($uploader->upload($fileJPG, 'test')) {
    echo 'success!';
} else {
    print_r($uploader->getErrors());
}