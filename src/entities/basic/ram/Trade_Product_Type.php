<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing TradeProductType
 *
 * XSD Type: TradeProductType
 */
class Trade_Product_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $globalID
     */
    private $global_id;
    /**
     * @var string $name
     */
    private $name;
    /**
     * Gets as globalID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function get_global_id()
    {
        return $this->global_id;
    }
    /**
     * Sets a new globalID
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\IDType $globalID
     */
    public function set_global_id(?\horstoeko\zugferd\entities\basic\udt\Id_Type $global_id = null): self
    {
        $this->global_id = $global_id;
        return $this;
    }
    /**
     * Gets as name
     *
     * @return string
     */
    public function get_name()
    {
        return $this->name;
    }
    /**
     * Sets a new name
     *
     * @param  string $name
     */
    public function set_name($name): self
    {
        $this->name = $name;
        return $this;
    }
}