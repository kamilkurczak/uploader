<?php 

namespace Tokk\Uploader\Validator;

interface Validator
{
    public function isValid();
    
    public function getErrors();
}