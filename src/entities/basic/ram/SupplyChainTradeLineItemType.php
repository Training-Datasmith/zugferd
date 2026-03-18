<?php

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing SupplyChainTradeLineItemType
 *
 * XSD Type: SupplyChainTradeLineItemType
 */
class SupplyChainTradeLineItemType
{

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\DocumentLineDocumentType $associatedDocumentLineDocument
     */
    private $associatedDocumentLineDocument;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradeProductType $specifiedTradeProduct
     */
    private $specifiedTradeProduct;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\LineTradeAgreementType $specifiedLineTradeAgreement
     */
    private $specifiedLineTradeAgreement;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\LineTradeDeliveryType $specifiedLineTradeDelivery
     */
    private $specifiedLineTradeDelivery;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\LineTradeSettlementType $specifiedLineTradeSettlement
     */
    private $specifiedLineTradeSettlement;

    /**
     * Gets as associatedDocumentLineDocument
     *
     * @return \horstoeko\zugferd\entities\basic\ram\DocumentLineDocumentType
     */
    public function getAssociatedDocumentLineDocument()
    {
        return $this->associatedDocumentLineDocument;
    }

    /**
     * Sets a new associatedDocumentLineDocument
     */
    public function setAssociatedDocumentLineDocument(\horstoeko\zugferd\entities\basic\ram\DocumentLineDocumentType $associatedDocumentLineDocument): self
    {
        $this->associatedDocumentLineDocument = $associatedDocumentLineDocument;
        return $this;
    }

    /**
     * Gets as specifiedTradeProduct
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradeProductType
     */
    public function getSpecifiedTradeProduct()
    {
        return $this->specifiedTradeProduct;
    }

    /**
     * Sets a new specifiedTradeProduct
     */
    public function setSpecifiedTradeProduct(\horstoeko\zugferd\entities\basic\ram\TradeProductType $specifiedTradeProduct): self
    {
        $this->specifiedTradeProduct = $specifiedTradeProduct;
        return $this;
    }

    /**
     * Gets as specifiedLineTradeAgreement
     *
     * @return \horstoeko\zugferd\entities\basic\ram\LineTradeAgreementType
     */
    public function getSpecifiedLineTradeAgreement()
    {
        return $this->specifiedLineTradeAgreement;
    }

    /**
     * Sets a new specifiedLineTradeAgreement
     */
    public function setSpecifiedLineTradeAgreement(\horstoeko\zugferd\entities\basic\ram\LineTradeAgreementType $specifiedLineTradeAgreement): self
    {
        $this->specifiedLineTradeAgreement = $specifiedLineTradeAgreement;
        return $this;
    }

    /**
     * Gets as specifiedLineTradeDelivery
     *
     * @return \horstoeko\zugferd\entities\basic\ram\LineTradeDeliveryType
     */
    public function getSpecifiedLineTradeDelivery()
    {
        return $this->specifiedLineTradeDelivery;
    }

    /**
     * Sets a new specifiedLineTradeDelivery
     */
    public function setSpecifiedLineTradeDelivery(\horstoeko\zugferd\entities\basic\ram\LineTradeDeliveryType $specifiedLineTradeDelivery): self
    {
        $this->specifiedLineTradeDelivery = $specifiedLineTradeDelivery;
        return $this;
    }

    /**
     * Gets as specifiedLineTradeSettlement
     *
     * @return \horstoeko\zugferd\entities\basic\ram\LineTradeSettlementType
     */
    public function getSpecifiedLineTradeSettlement()
    {
        return $this->specifiedLineTradeSettlement;
    }

    /**
     * Sets a new specifiedLineTradeSettlement
     */
    public function setSpecifiedLineTradeSettlement(\horstoeko\zugferd\entities\basic\ram\LineTradeSettlementType $specifiedLineTradeSettlement): self
    {
        $this->specifiedLineTradeSettlement = $specifiedLineTradeSettlement;
        return $this;
    }
}
