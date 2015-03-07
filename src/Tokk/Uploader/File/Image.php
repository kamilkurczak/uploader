<?php

namespace Tokk\Uploader\File;

class Image extends File
{
    public function __construct($file)
    {
        parent::__construct($file);
        $this->file = \imagecreatefromjpeg($file);
    }

    public function getWidth()
    {
        return \imagesx($this->file);
    }

    public function getHeight()
    {
        return \imagesy($this->file);
    }

    public function save($fileName, $uploadDir, $permissions = null)
    {
        $this->uploadDir = $uploadDir;
        \imagejpeg($this->file, "{$this->uploadDir}/{$fileName}.{$this->extension}");

        if( $permissions != null) {
            \chmod("{$this->uploadDir}/{$fileName}.{$this->extension}", $permissions);
        }
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }
}