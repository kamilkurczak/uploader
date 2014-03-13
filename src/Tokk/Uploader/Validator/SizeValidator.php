<?php 

namespace Tokk\Uploader\Validator;

use Tokk\Uploader\File\File;

class SizeValidator extends AbstractValidator
{
    protected $minMessage = 'File size is to small';
    
    protected $maxMessage = 'File size is to big';
    
    protected $min = 0;
    
    protected $max = 0;
    
    public function __construct($min = 0, $max = 0, $minMessage = null, $maxMessage = null)
    {
        parent::__construct();
        $this->min = $min;
        $this->max = $max;
        
        if ($minMessage) {
            $this->minMessage = $minMessage;
        }
        
        if ($maxMessage) {
            $this->maxMessage = $maxMessage;
        }
    }
    
    public function isValid(File $file)
    {
        return $this->validateMin($file) && $this->validateMax($file);
    }
    
    protected function validateMin(File $file)
    {
        if ($this->min && $file->getSize() < $this->min) {
            $this->errors[] = $this->minMessage;
            return false;
        }
        
        return true;
    }
    
    protected function validateMax(File $file)
    {
        if($this->max && $file->getSize() > $this->max) {
            $this->errors[] = $this->maxMessage;
            return false;
        }
        
        return true;
    }
}