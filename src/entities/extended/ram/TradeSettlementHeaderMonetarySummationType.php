<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeSettlementHeaderMonetarySummationType
 *
 * XSD Type: TradeSettlementHeaderMonetarySummationType
 */
class TradeSettlementHeaderMonetarySummationType
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
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $taxBasisTotalAmount
     */
    private $taxBasisTotalAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType[] $taxTotalAmount
     */
    private $taxTotalAmount = [

    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $roundingAmount
     */
    private $roundingAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $grandTotalAmount
     */
    private $grandTotalAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $totalPrepaidAmount
     */
    private $totalPrepaidAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $duePayableAmount
     */
    private $duePayableAmount;

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
     * Gets as taxBasisTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getTaxBasisTotalAmount()
    {
        return $this->taxBasisTotalAmount;
    }

    /**
     * Sets a new taxBasisTotalAmount
     */
    public function setTaxBasisTotalAmount(\horstoeko\zugferd\entities\extended\udt\AmountType $taxBasisTotalAmount): self
    {
        $this->taxBasisTotalAmount = $taxBasisTotalAmount;
        return $this;
    }

    /**
     * Adds as taxTotalAmount
     */
    public function addToTaxTotalAmount(\horstoeko\zugferd\entities\extended\udt\AmountType $taxTotalAmount): self
    {
        $this->taxTotalAmount[] = $taxTotalAmount;
        return $this;
    }

    /**
     * isset taxTotalAmount
     *
     * @param  int|string $index
     */
    public function issetTaxTotalAmount($index): bool
    {
        return isset($this->taxTotalAmount[$index]);
    }

    /**
     * unset taxTotalAmount
     *
     * @param  int|string $index
     */
    public function unsetTaxTotalAmount($index): void
    {
        unset($this->taxTotalAmount[$index]);
    }

    /**
     * Gets as taxTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType[]
     */
    public function getTaxTotalAmount()
    {
        return $this->taxTotalAmount;
    }

    /**
     * Sets a new taxTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType[] $taxTotalAmount
     */
    public function setTaxTotalAmount(?array $taxTotalAmount = null): self
    {
        $this->taxTotalAmount = $taxTotalAmount;
        return $this;
    }

    /**
     * Gets as roundingAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getRoundingAmount()
    {
        return $this->roundingAmount;
    }

    /**
     * Sets a new roundingAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $roundingAmount
     */
    public function setRoundingAmount(?\horstoeko\zugferd\entities\extended\udt\AmountType $roundingAmount = null): self
    {
        $this->roundingAmount = $roundingAmount;
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
     */
    public function setGrandTotalAmount(\horstoeko\zugferd\entities\extended\udt\AmountType $grandTotalAmount): self
    {
        $this->grandTotalAmount = $grandTotalAmount;
        return $this;
    }

    /**
     * Gets as totalPrepaidAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getTotalPrepaidAmount()
    {
        return $this->totalPrepaidAmount;
    }

    /**
     * Sets a new totalPrepaidAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $totalPrepaidAmount
     */
    public function setTotalPrepaidAmount(?\horstoeko\zugferd\entities\extended\udt\AmountType $totalPrepaidAmount = null): self
    {
        $this->totalPrepaidAmount = $totalPrepaidAmount;
        return $this;
    }

    /**
     * Gets as duePayableAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getDuePayableAmount()
    {
        return $this->duePayableAmount;
    }

    /**
     * Sets a new duePayableAmount
     */
    public function setDuePayableAmount(\horstoeko\zugferd\entities\extended\udt\AmountType $duePayableAmount): self
    {
        $this->duePayableAmount = $duePayableAmount;
        return $this;
    }
}
