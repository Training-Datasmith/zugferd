<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing LineTradeDeliveryType
 *
 * XSD Type: LineTradeDeliveryType
 */
class Line_Trade_Delivery_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\QuantityType $billedQuantity
     */
    private $billed_quantity;
    /**
     * Gets as billedQuantity
     *
     * @return \horstoeko\zugferd\entities\basic\udt\QuantityType
     */
    public function get_billed_quantity()
    {
        return $this->billed_quantity;
    }
    /**
     * Sets a new billedQuantity
     */
    public function set_billed_quantity(\horstoeko\zugferd\entities\basic\udt\Quantity_Type $billed_quantity): self
    {
        $this->billed_quantity = $billed_quantity;
        return $this;
    }
}