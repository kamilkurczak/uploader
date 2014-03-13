<?php 

namespace Tokk\Uploader\File;

class File
{
    /**
     * Type
     *
     * @var string
     */
    protected $type;
    
    /**
     * Extension
     *
     * @var string
     */
    protected $extension;
    
    protected $uploadDir;
    
    protected $file;
    
    protected $size = 0;
    
    public function __construct($file)
    {
        $this->file = $file;
        $this->setFileInfo();
    }
    
    protected function setFileInfo()
    {
        $pathInfo = pathinfo($this->file);
        $this->extension = $pathInfo['extension'];
        $this->size = filesize($this->file);
    }

    public function save($fileName, $uploadDir, $permissions = null)
    {
        $this->uploadDir = $uploadDir;
        \copy($this->file, "{$this->uploadDir}/{$fileName}.{$this->extension}");
    
        if( $permissions != null) {
            \chmod("{$this->uploadDir}/{$fileName}.{$this->extension}", $permissions);
        }
    }
    
    public function getSize()
    {
        return $this->size;
    }
}