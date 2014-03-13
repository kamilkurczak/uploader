<?php 

namespace Tokk\Uploader\Validator;

use Tokk\Uploader\File\File;

abstract class AbstractValidator implements Validator
{
    protected $errors;
    
    public function __construct()
    {
        $this->errors = array();
    }
    
    public function isValid(File $file) {}
    
    public function getErrors()
    {
        return $this->errors;
    }
}