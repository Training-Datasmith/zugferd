<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ProductClassificationType
 *
 * XSD Type: ProductClassificationType
 */
class ProductClassificationType
{

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\CodeType $classCode
     */
    private $classCode;

    /**
     * @var string $className
     */
    private $className;

    /**
     * Gets as classCode
     *
     * @return \horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function getClassCode()
    {
        return $this->classCode;
    }

    /**
     * Sets a new classCode
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\CodeType $classCode
     */
    public function setClassCode(?\horstoeko\zugferd\entities\extended\udt\CodeType $classCode = null): self
    {
        $this->classCode = $classCode;
        return $this;
    }

    /**
     * Gets as className
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Sets a new className
     *
     * @param  string $className
     */
    public function setClassName($className): self
    {
        $this->className = $className;
        return $this;
    }
}
