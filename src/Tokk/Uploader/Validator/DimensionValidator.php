<?php 

namespace Tokk\Uploader\Validator;

use Tokk\Uploader\File\File;

class DimensionValidator extends AbstractValidator
{
    protected $minWidthMessage = 'File width is to small';
    
    protected $maxWidthMessage = 'File width is to big';
    
    protected $minHeigthMessage = 'File heigth is to small';
    
    protected $maxHeigthMessage = 'File heigth is to big';
    
    protected $minWidth = 0;
    
    protected $maxWidth = 0;
    
    protected $minHeigth = 0;
    
    protected $maxHeigth = 0;
    
    public function __construct($minWidth = 0, $maxWidth = 0, $minHeigth = 0, $maxHeigth = 0)
    {
        parent::__construct();
        $this->minWidth = $minWidth;
        $this->maxWidth = $maxWidth;
        $this->minHeigth = $minHeigth;
        $this->maxHeigth = $maxHeigth;
        
        /*if ($minMessage) {
            $this->minMessage = $minMessage;
        }
        
        if ($maxMessage) {
            $this->maxMessage = $maxMessage;
        }*/
    }
    
    public function isValid(File $file)
    {
        return $this->validateMinWidth($file) && $this->validateMaxWidth($file)
            && $this->validateMinHeigth($file) && $this->validateMaxHeigth($file)
        ;
    }
    
    protected function validateMinWidth(File $file)
    {
        if ($this->minWidth && $file->getWidth() < $this->minWidth) {
            $this->errors[] = $this->minWidthMessage;
            return false;
        }
        
        return true;
    }
    
    protected function validateMaxWidth(File $file)
    {
        if($this->maxWidth && $file->getWidth() > $this->maxWidth) {
            $this->errors[] = $this->maxWidthMessage;
            return false;
        }
        
        return true;
    }
    
    protected function validateMinHeigth(File $file)
    {
        if ($this->minHeigth && $file->getHeigth() < $this->minHeigth) {
            $this->errors[] = $this->minHeigthMessage;
            return false;
        }
    
        return true;
    }
    
    protected function validateMaxHeigth(File $file)
    {
        if($this->maxHeigth && $file->getHeigth() > $this->maxHeigth) {
            $this->errors[] = $this->maxHeigthMessage;
            return false;
        }
    
        return true;
    }
}