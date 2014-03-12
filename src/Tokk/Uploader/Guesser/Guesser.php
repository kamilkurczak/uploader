<?php 

namespace Tokk\Uploader\Guesser;

interface Guesser
{
    public function guess($file);
}