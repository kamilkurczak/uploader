<?php

namespace Tokk\Uploader\Callback;

use Tokk\Uploader\File\Image;

class Resizer extends AbstractCallback
{
    protected $resizeToHeight;

    protected $resizeToWidth;

    protected $image;

    public function __construct($resizeToWidth = 0, $resizeToHeight = 0)
    {
        $this->resizeToWidth = $resizeToWidth;
        $this->resizeToHeight = $resizeToHeight;
        $this->callableMethod = 'resize';
        parent::__construct(CallbackEvent::postBind);
    }

    public function resize(Image $image)
    {
        $this->image = $image;

        if ($this->resizeToHeight) {
            $this->resizeToHeight();
        }

        if ($this->resizeToWidth) {
            $this->resizeToWidth();
        }
    }

    protected function resizeToHeight()
    {
        $ratio = $this->resizeToHeight / $this->image->getHeight();
        $width = $this->image->getWidth() * $ratio;
        $this->resizeFile($width, $this->resizeToHeight);
    }

    protected function resizeToWidth()
    {
        $ratio = $this->resizeToWidth / $this->image->getWidth();
        $height = $this->image->getheight() * $ratio;
        $this->resizeFile($this->resizeToWidth, $height);
    }

    protected function resizeFile($width, $height)
    {
        $newFile = \imagecreatetruecolor($width, $height);
        \imagecopyresampled($newFile, $this->image->getFile(), 0, 0, 0, 0, $width, $height, $this->image->getWidth(), $this->image->getHeight());
        $this->image->setFile($newFile);
    }
}