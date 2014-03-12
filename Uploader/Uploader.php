<?php 

namespace Tokk\Uploader\Uploader;

use Tokk\Uploader\Guesser\Guesser;

class Uploader
{
    protected $uploadDir;
    
    protected $guesser;
    
    public function __construct($uploadDir)
    {
        $this->uploadDir = $uploadDir;
        $this->guesser   = new Guesser();
    }
    
    public function upload($file, $fileType = null)
    {
        if (!$fileType) {
            $fileType = $this->guesser->guess($file);
        }
    }
    
    protected function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    
        if(!is_dir($this->getUploadRootDir())) {
            mkdir($this->getUploadRootDir(), 0777, true);
        }
    }
    
    protected function getUploadDir()
    {
        return $this->uploadDir;
    }
}