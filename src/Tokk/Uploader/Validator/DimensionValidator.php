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
        return $this->validateMin($file, 'Width') && $this->validateMax($file, 'Width')
            && $this->validateMin($file, 'Heigth') && $this->validateMax($file, 'Heigth')
        ;
    }
    
    protected function validateMin(File $file, $type)
    {
        if ($this->{"min{$type}"} && $file->{"get{$type}"}() < $this->{"min{$type}"}) {
            $this->errors[] = $this->{"min{$type}Message"};
            return false;
        }
        
        return true;
    }
    
    protected function validateMax(File $file, $type)
    {
        if($this->{"max{$type}"} && $file->{"get{$type}"}() > $this->{"max{$type}"}) {
            $this->errors[] = $this->{"max{$type}Message"};
            return false;
        }
        
        return true;
    }
}