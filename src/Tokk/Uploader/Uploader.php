<?php 

namespace Tokk\Uploader;

use Tokk\Uploader\Guesser\FileTypeGuesser;
use Tokk\Uploader\Guesser\Guesser;
use Tokk\Uploader\File\File;
use Tokk\Uploader\Validator\Validator;

class Uploader
{
    protected $uploadDir;
    
    protected $uploadRootDir;
    
    protected $guesser;
    
    protected $validators = array();
    
    protected $errors = array();
    
    public function __construct($uploadRootDir, Guesser $guesser = null)
    {
        $this->setUploadRootDir($uploadRootDir);
        $guesser ? $this->guesser = $guesser : $this->guesser = new FileTypeGuesser();
    }
    
    public function upload($file, $uploadDir = '', $name = null, $fileType = null)
    {
        if ($uploadDir) {
            $this->setUploadDir($uploadDir);
        }
        
        if (!$fileType) {
            $fileType = $this->guesser->guess($file);
        }
        
        //must be done by factory
        $uploadedFile = new File($file);
        
        //validate
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($uploadedFile)) {
                $this->errors[] = $validator->getErrors();
            }
        }

        if (count($this->errors)) {
            return false;
        }
        
        $fileName = $name ? $name : uniqid();
        $uploadedFile->save($fileName, $this->getFullUploadDir());
        return true;
    }
    
    protected function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    
        if(!is_dir($this->getUploadRootDir() . $this->uploadDir)) {
            mkdir($this->getUploadRootDir() . $this->uploadDir, 0777, true);
        }
    }
    
    protected function getUploadDir()
    {
        return $this->uploadDir;
    }
    
    protected function setUploadRootDir($uploadRootDir)
    {
        $this->uploadRootDir = $uploadRootDir;
    
        if(!is_dir($this->uploadRootDir)) {
            mkdir($this->uploadRootDir, 0777, true);
        }
    }
    
    public function getUploadRootDir()
    {
        return $this->uploadRootDir;
    }
    
    public function setGuesser(Guesser $guesser) 
    {
        $this->guesser = $guesser;
    }
    
    protected function getFullUploadDir()
    {
        return $this->uploadRootDir . '/' . $this->uploadDir;
    }
    
    public function addValidator(Validator $validator)
    {
        $this->validators[] = $validator;
    }
    
    public function setValidators($validators)
    {
        $this->validators = $validators;
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
}