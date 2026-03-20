<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing ProductCharacteristicType
 *
 * XSD Type: ProductCharacteristicType
 */
class Product_Characteristic_Type
{
    /**
     * @var string $description
     */
    private $description;
    /**
     * @var string $value
     */
    private $value;
    /**
     * Gets as description
     *
     * @return string
     */
    public function get_description()
    {
        return $this->description;
    }
    /**
     * Sets a new description
     *
     * @param  string $description
     */
    public function set_description($description): self
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Gets as value
     *
     * @return string
     */
    public function get_value()
    {
        return $this->value;
    }
    /**
     * Sets a new value
     *
     * @param  string $value
     */
    public function set_value($value): self
    {
        $this->value = $value;
        return $this;
    }
}