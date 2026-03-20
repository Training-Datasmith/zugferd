<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ProductCharacteristicType
 *
 * XSD Type: ProductCharacteristicType
 */
class Product_Characteristic_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\CodeType $typeCode
     */
    private $type_code;
    /**
     * @var string $description
     */
    private $description;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\MeasureType $valueMeasure
     */
    private $value_measure;
    /**
     * @var string $value
     */
    private $value;
    /**
     * Gets as typeCode
     *
     * @return \horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function get_type_code()
    {
        return $this->type_code;
    }
    /**
     * Sets a new typeCode
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\CodeType $typeCode
     */
    public function set_type_code(?\horstoeko\zugferd\entities\extended\udt\Code_Type $type_code = null): self
    {
        $this->type_code = $type_code;
        return $this;
    }
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
     * Gets as valueMeasure
     *
     * @return \horstoeko\zugferd\entities\extended\udt\MeasureType
     */
    public function get_value_measure()
    {
        return $this->value_measure;
    }
    /**
     * Sets a new valueMeasure
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\MeasureType $valueMeasure
     */
    public function set_value_measure(?\horstoeko\zugferd\entities\extended\udt\Measure_Type $value_measure = null): self
    {
        $this->value_measure = $value_measure;
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