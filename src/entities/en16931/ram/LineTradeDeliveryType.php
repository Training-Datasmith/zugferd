<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing LineTradeDeliveryType
 *
 * XSD Type: LineTradeDeliveryType
 */
class LineTradeDeliveryType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\QuantityType $billedQuantity
     */
    private $billedQuantity;

    /**
     * Gets as billedQuantity
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\QuantityType
     */
    public function getBilledQuantity()
    {
        return $this->billedQuantity;
    }

    /**
     * Sets a new billedQuantity
     */
    public function setBilledQuantity(\horstoeko\zugferd\entities\en16931\udt\QuantityType $billedQuantity): self
    {
        $this->billedQuantity = $billedQuantity;
        return $this;
    }
}
