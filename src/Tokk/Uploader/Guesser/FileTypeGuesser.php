<?php 

namespace Tokk\Uploader\Guesser;

class FileTypeGuesser implements Guesser
{
    public function guess($file)
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