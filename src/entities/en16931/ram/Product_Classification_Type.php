<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing ProductClassificationType
 *
 * XSD Type: ProductClassificationType
 */
class Product_Classification_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\CodeType $classCode
     */
    private $class_code;
    /**
     * Gets as classCode
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\CodeType
     */
    public function get_class_code()
    {
        return $this->class_code;
    }
    /**
     * Sets a new classCode
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\CodeType $classCode
     */
    public function set_class_code(?\horstoeko\zugferd\entities\en16931\udt\Code_Type $class_code = null): self
    {
        $this->class_code = $class_code;
        return $this;
    }
}