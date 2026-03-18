<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing ProductCharacteristicType
 *
 * XSD Type: ProductCharacteristicType
 */
class ProductCharacteristicType
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets a new description
     *
     * @param  string $description
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets as value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets a new value
     *
     * @param  string $value
     */
    public function setValue($value): self
    {
        $this->value = $value;
        return $this;
    }
}
