<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing SupplyChainTradeLineItemType
 *
 * XSD Type: SupplyChainTradeLineItemType
 */
class SupplyChainTradeLineItemType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\DocumentLineDocumentType $associatedDocumentLineDocument
     */
    private $associatedDocumentLineDocument;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeProductType $specifiedTradeProduct
     */
    private $specifiedTradeProduct;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\LineTradeAgreementType $specifiedLineTradeAgreement
     */
    private $specifiedLineTradeAgreement;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\LineTradeDeliveryType $specifiedLineTradeDelivery
     */
    private $specifiedLineTradeDelivery;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\LineTradeSettlementType $specifiedLineTradeSettlement
     */
    private $specifiedLineTradeSettlement;

    /**
     * Gets as associatedDocumentLineDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\DocumentLineDocumentType
     */
    public function getAssociatedDocumentLineDocument()
    {
        return $this->associatedDocumentLineDocument;
    }

    /**
     * Sets a new associatedDocumentLineDocument
     */
    public function setAssociatedDocumentLineDocument(\horstoeko\zugferd\entities\en16931\ram\DocumentLineDocumentType $associatedDocumentLineDocument): self
    {
        $this->associatedDocumentLineDocument = $associatedDocumentLineDocument;
        return $this;
    }

    /**
     * Gets as specifiedTradeProduct
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeProductType
     */
    public function getSpecifiedTradeProduct()
    {
        return $this->specifiedTradeProduct;
    }

    /**
     * Sets a new specifiedTradeProduct
     */
    public function setSpecifiedTradeProduct(\horstoeko\zugferd\entities\en16931\ram\TradeProductType $specifiedTradeProduct): self
    {
        $this->specifiedTradeProduct = $specifiedTradeProduct;
        return $this;
    }

    /**
     * Gets as specifiedLineTradeAgreement
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\LineTradeAgreementType
     */
    public function getSpecifiedLineTradeAgreement()
    {
        return $this->specifiedLineTradeAgreement;
    }

    /**
     * Sets a new specifiedLineTradeAgreement
     */
    public function setSpecifiedLineTradeAgreement(\horstoeko\zugferd\entities\en16931\ram\LineTradeAgreementType $specifiedLineTradeAgreement): self
    {
        $this->specifiedLineTradeAgreement = $specifiedLineTradeAgreement;
        return $this;
    }

    /**
     * Gets as specifiedLineTradeDelivery
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\LineTradeDeliveryType
     */
    public function getSpecifiedLineTradeDelivery()
    {
        return $this->specifiedLineTradeDelivery;
    }

    /**
     * Sets a new specifiedLineTradeDelivery
     */
    public function setSpecifiedLineTradeDelivery(\horstoeko\zugferd\entities\en16931\ram\LineTradeDeliveryType $specifiedLineTradeDelivery): self
    {
        $this->specifiedLineTradeDelivery = $specifiedLineTradeDelivery;
        return $this;
    }

    /**
     * Gets as specifiedLineTradeSettlement
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\LineTradeSettlementType
     */
    public function getSpecifiedLineTradeSettlement()
    {
        return $this->specifiedLineTradeSettlement;
    }

    /**
     * Sets a new specifiedLineTradeSettlement
     */
    public function setSpecifiedLineTradeSettlement(\horstoeko\zugferd\entities\en16931\ram\LineTradeSettlementType $specifiedLineTradeSettlement): self
    {
        $this->specifiedLineTradeSettlement = $specifiedLineTradeSettlement;
        return $this;
    }
}
