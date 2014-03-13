<?php 

$loader = require_once __DIR__.'/vendor/autoload.php';

use Tokk\Uploader\Uploader;
use Tokk\Uploader\Validator\SizeValidator;

//set up uploader (without last "/")
$uploadRootDir = '/home/kamil/uploader';
$uploader = new Uploader($uploadRootDir);

//base file upload to custom directory
$fileJPG = '/home/kamil/tymek.jpg';
$filePNG = '/home/kamil/test.png';

$uploader->addValidator(new SizeValidator(50, 200000));
if ($uploader->upload($fileJPG, 'test')) {
    echo 'success!';
} else {
    print_r($uploader->getErrors());
}