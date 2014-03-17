<?php

namespace Tokk\Uploader\File;

interface Factory
{
    public static function make($fileType, $file);
}