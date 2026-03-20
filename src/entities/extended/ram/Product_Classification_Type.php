<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ProductClassificationType
 *
 * XSD Type: ProductClassificationType
 */
class Product_Classification_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\CodeType $classCode
     */
    private $class_code;
    /**
     * @var string $className
     */
    private $class_name;
    /**
     * Gets as classCode
     *
     * @return \horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function get_class_code()
    {
        return $this->class_code;
    }
    /**
     * Sets a new classCode
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\CodeType $classCode
     */
    public function set_class_code(?\horstoeko\zugferd\entities\extended\udt\Code_Type $class_code = null): self
    {
        $this->class_code = $class_code;
        return $this;
    }
    /**
     * Gets as className
     *
     * @return string
     */
    public function get_class_name()
    {
        return $this->class_name;
    }
    /**
     * Sets a new className
     *
     * @param  string $className
     */
    public function set_class_name($class_name): self
    {
        $this->class_name = $class_name;
        return $this;
    }
}