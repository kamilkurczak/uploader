<?php

namespace Tokk\Uploader\Validator;

use Tokk\Uploader\File\File;

interface Validator
{
    public function isValid(File $file);

    public function getErrors();

    public function getType();
}