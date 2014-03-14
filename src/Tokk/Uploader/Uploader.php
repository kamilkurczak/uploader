<?php

namespace Tokk\Uploader;

use Tokk\Uploader\Guesser\FileTypeGuesser;
use Tokk\Uploader\Guesser\Guesser;
use Tokk\Uploader\File\File;
use Tokk\Uploader\File\Image;
use Tokk\Uploader\Validator\Validator;
use Tokk\Uploader\File\FileFactory;
use Tokk\Uploader\File\FileType;
use Tokk\Uploader\Callback\Callback;
use Tokk\Uploader\Callback\CallbackEvent;

class Uploader
{
    protected $uploadDir;

    protected $uploadRootDir;

    protected $guesser;

    protected $fileFactory;

    protected $validators = array();

    protected $callbacks = array();

    protected $errors = array();

    protected $fileClassess = array();

    public function __construct($uploadRootDir, Guesser $guesser = null, $fileClassess = array())
    {
        $this->setUploadRootDir($uploadRootDir);
        $this->guesser = $guesser ? $guesser : new FileTypeGuesser();
        $this->fileClassess = $fileClassess;

        $this->callbacks = array(
            CallbackEvent::postBind => array(),
            CallbackEvent::preSave => array(),
            CallbackEvent::postSave => array()
        );
    }

    public function upload($file, $uploadDir = '', $name = null, FileType $fileType = null)
    {
        if ($uploadDir) {
            $this->setUploadDir($uploadDir);
        }

        if (!$fileType) {
            $fileType = $this->guesser->guess($file);
        }

        $uploadedFile = FileFactory::make($fileType, $file, $this->fileClassess);

        $this->validate($uploadedFile);
        $this->callback(CallbackEvent::postBind, $uploadedFile);

        if (count($this->errors)) {
            return false;
        }

        $fileName = $name ? $name : uniqid();

        $this->callback(CallbackEvent::preSave, $uploadedFile);
        $uploadedFile->save($fileName, $this->getFullUploadDir());
        $this->callback(CallbackEvent::postSave, $uploadedFile);
        return true;
    }

    protected function validate(File $file)
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($file)) {
                $this->errors[] = $validator->getErrors();
            }
        }
    }

    protected function callback($event, $file)
    {
        foreach ($this->callbacks[$event] as $callback) {
            $callback->call($file);
        }
    }

    protected function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir;

        if(!is_dir($this->getUploadRootDir() . $this->uploadDir)) {
            mkdir($this->getUploadRootDir() . $this->uploadDir, 0777, true);
        }
    }

    protected function getUploadDir()
    {
        return $this->uploadDir;
    }

    protected function setUploadRootDir($uploadRootDir)
    {
        $this->uploadRootDir = $uploadRootDir;

        if(!is_dir($this->uploadRootDir)) {
            mkdir($this->uploadRootDir, 0777, true);
        }
    }

    public function getUploadRootDir()
    {
        return $this->uploadRootDir . '/';
    }

    public function setGuesser(Guesser $guesser)
    {
        $this->guesser = $guesser;
    }

    protected function getFullUploadDir()
    {
        return $this->uploadRootDir . '/' . $this->uploadDir;
    }

    public function addValidator(Validator $validator)
    {
        $this->validators[] = $validator;
    }

    public function setValidators($validators)
    {
        $this->validators = $validators;
    }

    public function addCallback(Callback $callback)
    {
        $this->callbacks[$callback->getEvent()][] = $callback;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}