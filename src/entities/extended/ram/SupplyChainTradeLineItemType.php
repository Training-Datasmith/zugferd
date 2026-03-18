<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing SupplyChainTradeLineItemType
 *
 * XSD Type: SupplyChainTradeLineItemType
 */
class SupplyChainTradeLineItemType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\DocumentLineDocumentType $associatedDocumentLineDocument
     */
    private $associatedDocumentLineDocument;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeProductType $specifiedTradeProduct
     */
    private $specifiedTradeProduct;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\LineTradeAgreementType $specifiedLineTradeAgreement
     */
    private $specifiedLineTradeAgreement;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\LineTradeDeliveryType $specifiedLineTradeDelivery
     */
    private $specifiedLineTradeDelivery;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\LineTradeSettlementType $specifiedLineTradeSettlement
     */
    private $specifiedLineTradeSettlement;

    /**
     * Gets as associatedDocumentLineDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\DocumentLineDocumentType
     */
    public function getAssociatedDocumentLineDocument()
    {
        return $this->associatedDocumentLineDocument;
    }

    /**
     * Sets a new associatedDocumentLineDocument
     */
    public function setAssociatedDocumentLineDocument(\horstoeko\zugferd\entities\extended\ram\DocumentLineDocumentType $associatedDocumentLineDocument): self
    {
        $this->associatedDocumentLineDocument = $associatedDocumentLineDocument;
        return $this;
    }

    /**
     * Gets as specifiedTradeProduct
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeProductType
     */
    public function getSpecifiedTradeProduct()
    {
        return $this->specifiedTradeProduct;
    }

    /**
     * Sets a new specifiedTradeProduct
     */
    public function setSpecifiedTradeProduct(\horstoeko\zugferd\entities\extended\ram\TradeProductType $specifiedTradeProduct): self
    {
        $this->specifiedTradeProduct = $specifiedTradeProduct;
        return $this;
    }

    /**
     * Gets as specifiedLineTradeAgreement
     *
     * @return \horstoeko\zugferd\entities\extended\ram\LineTradeAgreementType
     */
    public function getSpecifiedLineTradeAgreement()
    {
        return $this->specifiedLineTradeAgreement;
    }

    /**
     * Sets a new specifiedLineTradeAgreement
     */
    public function setSpecifiedLineTradeAgreement(\horstoeko\zugferd\entities\extended\ram\LineTradeAgreementType $specifiedLineTradeAgreement): self
    {
        $this->specifiedLineTradeAgreement = $specifiedLineTradeAgreement;
        return $this;
    }

    /**
     * Gets as specifiedLineTradeDelivery
     *
     * @return \horstoeko\zugferd\entities\extended\ram\LineTradeDeliveryType
     */
    public function getSpecifiedLineTradeDelivery()
    {
        return $this->specifiedLineTradeDelivery;
    }

    /**
     * Sets a new specifiedLineTradeDelivery
     */
    public function setSpecifiedLineTradeDelivery(\horstoeko\zugferd\entities\extended\ram\LineTradeDeliveryType $specifiedLineTradeDelivery): self
    {
        $this->specifiedLineTradeDelivery = $specifiedLineTradeDelivery;
        return $this;
    }

    /**
     * Gets as specifiedLineTradeSettlement
     *
     * @return \horstoeko\zugferd\entities\extended\ram\LineTradeSettlementType
     */
    public function getSpecifiedLineTradeSettlement()
    {
        return $this->specifiedLineTradeSettlement;
    }

    /**
     * Sets a new specifiedLineTradeSettlement
     */
    public function setSpecifiedLineTradeSettlement(\horstoeko\zugferd\entities\extended\ram\LineTradeSettlementType $specifiedLineTradeSettlement): self
    {
        $this->specifiedLineTradeSettlement = $specifiedLineTradeSettlement;
        return $this;
    }
}
