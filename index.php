<?php 

$loader = require_once __DIR__.'/vendor/autoload.php';

use Tokk\Uploader\Uploader;

//set up uploader (without last "/")
$uploadRootDir = '/home/kamil/uploader';
$uploader = new Uploader($uploadRootDir);

//base file upload to custom directory
$fileJPG = '/home/kamil/tymek.jpg';
$filePNG = '/home/kamil/test.png';
$fileODS = '/home/kamil/godziny_pracy.ods';

$uploader->upload($fileODS, 'test');