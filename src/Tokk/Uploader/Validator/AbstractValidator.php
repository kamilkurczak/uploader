<?php 

namespace Tokk\Uploader\Validator;

abstract class AbstractValidator implements Valiator
{
    protected $errors;
    
    public function __construct()
    {
        $this->errors = array();
    }
    
    public function isValid() {}
    
    public function getErrors()
    {
        return $this->errors;
    }
}