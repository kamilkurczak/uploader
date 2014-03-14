<?php

namespace Tokk\Uploader\Callback;

use Tokk\Uploader\File\UploadedFile;

interface Callback
{
    public function call(UploadedFile $file);

    public function getEvent();
}