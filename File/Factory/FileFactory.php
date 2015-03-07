<?php

namespace Uploader\File\Factory;

use Uploader\Exception\WrongTypeException;
use Uploader\File\Builder\BuilderInterface;
use Uploader\File\Type\MimeType;
use Uploader\File\Type\MimeTypeInterface;

/**
 * Class FileFactory
 * @package Uploader\File\Factory
 */
class FileFactory implements FileFactoryInterface
{
    /**
     * @var MimeTypeInterface
     */
    protected $mimeType;

    /**
     * @var \ArrayObject
     */
    protected $builders;

    /**
     * @param MimeTypeInterface $mimeType
     */
    public function __construct(MimeTypeInterface $mimeType = null)
    {
        $this->builders = new \ArrayObject();
        $this->mimeType = $mimeType ? $mimeType : new MimeType();
    }

    public function make()
    {

    }

    /**
     * @param BuilderInterface $builder
     * @throws WrongTypeException
     */
    public function addBuilder(BuilderInterface $builder)
    {
        if (!in_array($builder->getType(), $this->mimeType->getSupportedTypes())) {
            throw new WrongTypeException("'{$builder->getType()}' is not supported file type");
        }
    }
}