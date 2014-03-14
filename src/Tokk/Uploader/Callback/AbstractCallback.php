<?php

namespace Tokk\Uploader\Callback;

use Tokk\Uploader\File\UploadedFile;

abstract class AbstractCallback implements Callback
{
    protected $event;

    protected $callableMethod;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function call(UploadedFile $file)
    {
        $callableMethod = $this->callableMethod;
        $this->$callableMethod($file);
    }

    public function getEvent()
    {
        return $this->event;
    }
}