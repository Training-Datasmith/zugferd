<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeSettlementLineMonetarySummationType
 *
 * XSD Type: TradeSettlementLineMonetarySummationType
 */
class TradeSettlementLineMonetarySummationType
{

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $lineTotalAmount
     */
    private $lineTotalAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $chargeTotalAmount
     */
    private $chargeTotalAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $allowanceTotalAmount
     */
    private $allowanceTotalAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $taxTotalAmount
     */
    private $taxTotalAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $grandTotalAmount
     */
    private $grandTotalAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $totalAllowanceChargeAmount
     */
    private $totalAllowanceChargeAmount;

    /**
     * Gets as lineTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getLineTotalAmount()
    {
        return $this->lineTotalAmount;
    }

    /**
     * Sets a new lineTotalAmount
     */
    public function setLineTotalAmount(\horstoeko\zugferd\entities\extended\udt\AmountType $lineTotalAmount): self
    {
        $this->lineTotalAmount = $lineTotalAmount;
        return $this;
    }

    /**
     * Gets as chargeTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getChargeTotalAmount()
    {
        return $this->chargeTotalAmount;
    }

    /**
     * Sets a new chargeTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $chargeTotalAmount
     */
    public function setChargeTotalAmount(?\horstoeko\zugferd\entities\extended\udt\AmountType $chargeTotalAmount = null): self
    {
        $this->chargeTotalAmount = $chargeTotalAmount;
        return $this;
    }

    /**
     * Gets as allowanceTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getAllowanceTotalAmount()
    {
        return $this->allowanceTotalAmount;
    }

    /**
     * Sets a new allowanceTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $allowanceTotalAmount
     */
    public function setAllowanceTotalAmount(?\horstoeko\zugferd\entities\extended\udt\AmountType $allowanceTotalAmount = null): self
    {
        $this->allowanceTotalAmount = $allowanceTotalAmount;
        return $this;
    }

    /**
     * Gets as taxTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getTaxTotalAmount()
    {
        return $this->taxTotalAmount;
    }

    /**
     * Sets a new taxTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $taxTotalAmount
     */
    public function setTaxTotalAmount(?\horstoeko\zugferd\entities\extended\udt\AmountType $taxTotalAmount = null): self
    {
        $this->taxTotalAmount = $taxTotalAmount;
        return $this;
    }

    /**
     * Gets as grandTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getGrandTotalAmount()
    {
        return $this->grandTotalAmount;
    }

    /**
     * Sets a new grandTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $grandTotalAmount
     */
    public function setGrandTotalAmount(?\horstoeko\zugferd\entities\extended\udt\AmountType $grandTotalAmount = null): self
    {
        $this->grandTotalAmount = $grandTotalAmount;
        return $this;
    }

    /**
     * Gets as totalAllowanceChargeAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getTotalAllowanceChargeAmount()
    {
        return $this->totalAllowanceChargeAmount;
    }

    /**
     * Sets a new totalAllowanceChargeAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $totalAllowanceChargeAmount
     */
    public function setTotalAllowanceChargeAmount(?\horstoeko\zugferd\entities\extended\udt\AmountType $totalAllowanceChargeAmount = null): self
    {
        $this->totalAllowanceChargeAmount = $totalAllowanceChargeAmount;
        return $this;
    }
}
