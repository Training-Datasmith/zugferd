<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing LineTradeAgreementType
 *
 * XSD Type: LineTradeAgreementType
 */
class LineTradeAgreementType
{
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradePriceType $grossPriceProductTradePrice
     */
    private $grossPriceProductTradePrice;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradePriceType $netPriceProductTradePrice
     */
    private $netPriceProductTradePrice;

    /**
     * Gets as grossPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradePriceType
     */
    public function getGrossPriceProductTradePrice()
    {
        return $this->grossPriceProductTradePrice;
    }

    /**
     * Sets a new grossPriceProductTradePrice
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\TradePriceType $grossPriceProductTradePrice
     */
    public function setGrossPriceProductTradePrice(?\horstoeko\zugferd\entities\basic\ram\TradePriceType $grossPriceProductTradePrice = null): self
    {
        $this->grossPriceProductTradePrice = $grossPriceProductTradePrice;
        return $this;
    }

    /**
     * Gets as netPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradePriceType
     */
    public function getNetPriceProductTradePrice()
    {
        return $this->netPriceProductTradePrice;
    }

    /**
     * Sets a new netPriceProductTradePrice
     */
    public function setNetPriceProductTradePrice(\horstoeko\zugferd\entities\basic\ram\TradePriceType $netPriceProductTradePrice): self
    {
        $this->netPriceProductTradePrice = $netPriceProductTradePrice;
        return $this;
    }
}
