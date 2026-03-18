<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing SupplyChainTradeTransactionType
 *
 * XSD Type: SupplyChainTradeTransactionType
 */
class SupplyChainTradeTransactionType
{
    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\HeaderTradeAgreementType $applicableHeaderTradeAgreement
     */
    private $applicableHeaderTradeAgreement;

    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\HeaderTradeDeliveryType $applicableHeaderTradeDelivery
     */
    private $applicableHeaderTradeDelivery;

    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\HeaderTradeSettlementType $applicableHeaderTradeSettlement
     */
    private $applicableHeaderTradeSettlement;

    /**
     * Gets as applicableHeaderTradeAgreement
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\HeaderTradeAgreementType
     */
    public function getApplicableHeaderTradeAgreement()
    {
        return $this->applicableHeaderTradeAgreement;
    }

    /**
     * Sets a new applicableHeaderTradeAgreement
     */
    public function setApplicableHeaderTradeAgreement(\horstoeko\zugferd\entities\minimum\ram\HeaderTradeAgreementType $applicableHeaderTradeAgreement): self
    {
        $this->applicableHeaderTradeAgreement = $applicableHeaderTradeAgreement;
        return $this;
    }

    /**
     * Gets as applicableHeaderTradeDelivery
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\HeaderTradeDeliveryType
     */
    public function getApplicableHeaderTradeDelivery()
    {
        return $this->applicableHeaderTradeDelivery;
    }

    /**
     * Sets a new applicableHeaderTradeDelivery
     */
    public function setApplicableHeaderTradeDelivery(\horstoeko\zugferd\entities\minimum\ram\HeaderTradeDeliveryType $applicableHeaderTradeDelivery): self
    {
        $this->applicableHeaderTradeDelivery = $applicableHeaderTradeDelivery;
        return $this;
    }

    /**
     * Gets as applicableHeaderTradeSettlement
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\HeaderTradeSettlementType
     */
    public function getApplicableHeaderTradeSettlement()
    {
        return $this->applicableHeaderTradeSettlement;
    }

    /**
     * Sets a new applicableHeaderTradeSettlement
     */
    public function setApplicableHeaderTradeSettlement(\horstoeko\zugferd\entities\minimum\ram\HeaderTradeSettlementType $applicableHeaderTradeSettlement): self
    {
        $this->applicableHeaderTradeSettlement = $applicableHeaderTradeSettlement;
        return $this;
    }
}
