<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing LineTradeAgreementType
 *
 * XSD Type: LineTradeAgreementType
 */
class LineTradeAgreementType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    private $buyerOrderReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePriceType $grossPriceProductTradePrice
     */
    private $grossPriceProductTradePrice;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePriceType $netPriceProductTradePrice
     */
    private $netPriceProductTradePrice;

    /**
     * Gets as buyerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function getBuyerOrderReferencedDocument()
    {
        return $this->buyerOrderReferencedDocument;
    }

    /**
     * Sets a new buyerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    public function setBuyerOrderReferencedDocument(?\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument = null): self
    {
        $this->buyerOrderReferencedDocument = $buyerOrderReferencedDocument;
        return $this;
    }

    /**
     * Gets as grossPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePriceType
     */
    public function getGrossPriceProductTradePrice()
    {
        return $this->grossPriceProductTradePrice;
    }

    /**
     * Sets a new grossPriceProductTradePrice
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradePriceType $grossPriceProductTradePrice
     */
    public function setGrossPriceProductTradePrice(?\horstoeko\zugferd\entities\en16931\ram\TradePriceType $grossPriceProductTradePrice = null): self
    {
        $this->grossPriceProductTradePrice = $grossPriceProductTradePrice;
        return $this;
    }

    /**
     * Gets as netPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePriceType
     */
    public function getNetPriceProductTradePrice()
    {
        return $this->netPriceProductTradePrice;
    }

    /**
     * Sets a new netPriceProductTradePrice
     */
    public function setNetPriceProductTradePrice(\horstoeko\zugferd\entities\en16931\ram\TradePriceType $netPriceProductTradePrice): self
    {
        $this->netPriceProductTradePrice = $netPriceProductTradePrice;
        return $this;
    }
}
