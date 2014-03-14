<?php

namespace Tokk\Uploader\Callback;

use Tokk\Uploader\File\File;

abstract class AbstractCallback implements Callback
{
    protected $event;

    public function __construct(CallbackEvent $event)
    {
        $this->event = $event;
    }

    public function call(File $file) {}

    public function getEvent()
    {
        return $this->event;
    }
}