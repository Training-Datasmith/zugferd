<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeDeliveryTermsType
 *
 * XSD Type: TradeDeliveryTermsType
 */
class Trade_Delivery_Terms_Type
{
    /**
     * @var string $deliveryTypeCode
     */
    private $delivery_type_code;
    /**
     * Gets as deliveryTypeCode
     *
     * @return string
     */
    public function get_delivery_type_code()
    {
        return $this->delivery_type_code;
    }
    /**
     * Sets a new deliveryTypeCode
     *
     * @param  string $deliveryTypeCode
     */
    public function set_delivery_type_code($delivery_type_code): self
    {
        $this->delivery_type_code = $delivery_type_code;
        return $this;
    }
}