<?php

namespace Tokk\Uploader\File;

interface UploadedFile
{
    public function save($fileName, $uploadDir, $permissions = null);

    public function getSize();
}