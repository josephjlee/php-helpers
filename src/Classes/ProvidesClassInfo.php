<?php

namespace SebastiaanLuca\PhpHelpers\Classes;

use ReflectionClass;

Trait ProvidesClassInfo
{
    protected $classDirectory;

    /**
     * Get the directory of the current class.
     *
     * Uses reflection to get the directory of the child class instead of the parent if applicable.
     *
     * @return string
     */
    protected function getClassDirectory() : string
    {
        // Some primitive caching
        if ($this->classDirectory) {
            return $this->classDirectory;
        }

        $reflection = new ReflectionClass(get_class($this));

        $this->classDirectory = dirname($reflection->getFileName());

        return $this->classDirectory;
    }
}
