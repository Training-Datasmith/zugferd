<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeDeliveryTermsType
 *
 * XSD Type: TradeDeliveryTermsType
 */
class TradeDeliveryTermsType
{
    /**
     * @var string $deliveryTypeCode
     */
    private $deliveryTypeCode;

    /**
     * Gets as deliveryTypeCode
     *
     * @return string
     */
    public function getDeliveryTypeCode()
    {
        return $this->deliveryTypeCode;
    }

    /**
     * Sets a new deliveryTypeCode
     *
     * @param  string $deliveryTypeCode
     */
    public function setDeliveryTypeCode($deliveryTypeCode): self
    {
        $this->deliveryTypeCode = $deliveryTypeCode;
        return $this;
    }
}
