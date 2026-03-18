<?php

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing LineTradeDeliveryType
 *
 * XSD Type: LineTradeDeliveryType
 */
class LineTradeDeliveryType
{

    /**
     * @var \horstoeko\zugferd\entities\basic\udt\QuantityType $billedQuantity
     */
    private $billedQuantity;

    /**
     * Gets as billedQuantity
     *
     * @return \horstoeko\zugferd\entities\basic\udt\QuantityType
     */
    public function getBilledQuantity()
    {
        return $this->billedQuantity;
    }

    /**
     * Sets a new billedQuantity
     */
    public function setBilledQuantity(\horstoeko\zugferd\entities\basic\udt\QuantityType $billedQuantity): self
    {
        $this->billedQuantity = $billedQuantity;
        return $this;
    }
}
