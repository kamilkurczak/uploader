<?php 

namespace Tokk\Uploader\File;

class Image extends File
{
    protected $width;
    
    protected $heigth;
    
    public function __construct($file)
    {
        parent::__construct($file);
        $this->width = \getimagesize($file)[0];
        $this->heigth = \getimagesize($file)[1];
    }
    
    public function getWidth()
    {
        return $this->width;
    }
    
    public function getHeigth()
    {
        return $this->heigth;
    }
}