<?php

namespace Uploader\File\Type;

class MimeType implements MimeTypeInterface
{
    const GIF = 'gif';

    const PDF = 'pdf';

    public function getSupportedTypes()
    {
        return [
            self::GIF,
            self::PDF
        ];

    }
}