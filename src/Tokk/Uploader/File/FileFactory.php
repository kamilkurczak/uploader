<?php

namespace  Tokk\Uploader\File;

class FileFactory implements Factory
{
    protected static $classess = array(
        FileType::FILE => 'Tokk\Uploader\File\File',
        FileType::IMAGE => 'Tokk\Uploader\File\Image'
    );

    public static function make($fileType, $file, $fileClassess = array())
    {
        self::$classess = array_merge(self::$classess, $fileClassess);

        if (isset(self::$classess[$fileType])) {
            return new self::$classess[$fileType]($file);
        } else {
            throw new \InvalidArgumentException('Wrong FileType');
        }
    }
}