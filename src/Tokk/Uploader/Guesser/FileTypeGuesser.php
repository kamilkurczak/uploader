<?php

namespace Tokk\Uploader\Guesser;

use Tokk\Uploader\File\FileType;

class FileTypeGuesser implements Guesser
{
    public function guess($file)
    {
        if (!$file) {
            throw new \InvalidArgumentException('Wrong file');
        }

        return $this->guessFileType($file);
    }

    protected function guessFileType($file)
    {
        $fileInfo = new \finfo(FILEINFO_MIME);  // object oriented approach!
        $mimeType = $fileInfo->buffer(file_get_contents($file));

        if(strstr($mimeType, 'image/')) {
            return FileType::IMAGE;
        } else {
            return FileType::FILE;
        }
    }
}