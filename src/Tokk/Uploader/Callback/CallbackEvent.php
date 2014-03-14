<?php

namespace Tokk\Uploader\Callback;

class CallbackEvent
{
    const preSave = 'preSave';
    const postSave = 'postSave';
    const preBind = 'preBind';
    const postBind = 'postBind';

    private function __construct() {}

    private function __clone() {}

    private function __wakeup() {}
}