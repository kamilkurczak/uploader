<?php

namespace  Tokk\Uploader\File;

class FileFactory implements Factory
{
    public static function make($fileType, $file)
    {
        switch ($fileType) {
            case FileType::IMAGE:
                return new Image($file);
                break;
            case FileType::FILE:
                return new File($file);
                break;
            default:
                throw new \InvalidArgumentException('Wrong FileType');
        }
    }
}