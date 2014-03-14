<?php

namespace Tokk\Uploader\Callback;

use Tokk\Uploader\File\File;

interface Callback
{
    public function call(File $file);

    public function getEvent();
}