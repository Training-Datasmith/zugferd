<?php

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing SupplyChainTradeTransactionType
 *
 * XSD Type: SupplyChainTradeTransactionType
 */
class SupplyChainTradeTransactionType
{

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\SupplyChainTradeLineItemType[] $includedSupplyChainTradeLineItem
     */
    private $includedSupplyChainTradeLineItem = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\HeaderTradeAgreementType $applicableHeaderTradeAgreement
     */
    private $applicableHeaderTradeAgreement;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\HeaderTradeDeliveryType $applicableHeaderTradeDelivery
     */
    private $applicableHeaderTradeDelivery;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\HeaderTradeSettlementType $applicableHeaderTradeSettlement
     */
    private $applicableHeaderTradeSettlement;

    /**
     * Adds as includedSupplyChainTradeLineItem
     */
    public function addToIncludedSupplyChainTradeLineItem(\horstoeko\zugferd\entities\basic\ram\SupplyChainTradeLineItemType $includedSupplyChainTradeLineItem): self
    {
        $this->includedSupplyChainTradeLineItem[] = $includedSupplyChainTradeLineItem;
        return $this;
    }

    /**
     * isset includedSupplyChainTradeLineItem
     *
     * @param  int|string $index
     */
    public function issetIncludedSupplyChainTradeLineItem($index): bool
    {
        return isset($this->includedSupplyChainTradeLineItem[$index]);
    }

    /**
     * unset includedSupplyChainTradeLineItem
     *
     * @param  int|string $index
     */
    public function unsetIncludedSupplyChainTradeLineItem($index): void
    {
        unset($this->includedSupplyChainTradeLineItem[$index]);
    }

    /**
     * Gets as includedSupplyChainTradeLineItem
     *
     * @return \horstoeko\zugferd\entities\basic\ram\SupplyChainTradeLineItemType[]
     */
    public function getIncludedSupplyChainTradeLineItem()
    {
        return $this->includedSupplyChainTradeLineItem;
    }

    /**
     * Sets a new includedSupplyChainTradeLineItem
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\SupplyChainTradeLineItemType[] $includedSupplyChainTradeLineItem
     */
    public function setIncludedSupplyChainTradeLineItem(array $includedSupplyChainTradeLineItem): self
    {
        $this->includedSupplyChainTradeLineItem = $includedSupplyChainTradeLineItem;
        return $this;
    }

    /**
     * Gets as applicableHeaderTradeAgreement
     *
     * @return \horstoeko\zugferd\entities\basic\ram\HeaderTradeAgreementType
     */
    public function getApplicableHeaderTradeAgreement()
    {
        return $this->applicableHeaderTradeAgreement;
    }

    /**
     * Sets a new applicableHeaderTradeAgreement
     */
    public function setApplicableHeaderTradeAgreement(\horstoeko\zugferd\entities\basic\ram\HeaderTradeAgreementType $applicableHeaderTradeAgreement): self
    {
        $this->applicableHeaderTradeAgreement = $applicableHeaderTradeAgreement;
        return $this;
    }

    /**
     * Gets as applicableHeaderTradeDelivery
     *
     * @return \horstoeko\zugferd\entities\basic\ram\HeaderTradeDeliveryType
     */
    public function getApplicableHeaderTradeDelivery()
    {
        return $this->applicableHeaderTradeDelivery;
    }

    /**
     * Sets a new applicableHeaderTradeDelivery
     */
    public function setApplicableHeaderTradeDelivery(\horstoeko\zugferd\entities\basic\ram\HeaderTradeDeliveryType $applicableHeaderTradeDelivery): self
    {
        $this->applicableHeaderTradeDelivery = $applicableHeaderTradeDelivery;
        return $this;
    }

    /**
     * Gets as applicableHeaderTradeSettlement
     *
     * @return \horstoeko\zugferd\entities\basic\ram\HeaderTradeSettlementType
     */
    public function getApplicableHeaderTradeSettlement()
    {
        return $this->applicableHeaderTradeSettlement;
    }

    /**
     * Sets a new applicableHeaderTradeSettlement
     */
    public function setApplicableHeaderTradeSettlement(\horstoeko\zugferd\entities\basic\ram\HeaderTradeSettlementType $applicableHeaderTradeSettlement): self
    {
        $this->applicableHeaderTradeSettlement = $applicableHeaderTradeSettlement;
        return $this;
    }
}
