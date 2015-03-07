<?php

namespace Uploader\File\Builder;

interface BuilderInterface
{
    public function build();

    public function getType();
}