<?php 

namespace Tokk\Uploader\Guesser;

class Guesser
{
    public function guess($file)
    {
        $fileType = 'image';
        
        return $fileType;
    }
}