<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing TradeSettlementHeaderMonetarySummationType
 *
 * XSD Type: TradeSettlementHeaderMonetarySummationType
 */
class TradeSettlementHeaderMonetarySummationType
{
    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\AmountType $taxBasisTotalAmount
     */
    private $taxBasisTotalAmount;

    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\AmountType[] $taxTotalAmount
     */
    private $taxTotalAmount = [

    ];

    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\AmountType $grandTotalAmount
     */
    private $grandTotalAmount;

    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\AmountType $duePayableAmount
     */
    private $duePayableAmount;

    /**
     * Gets as taxBasisTotalAmount
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\AmountType
     */
    public function getTaxBasisTotalAmount()
    {
        return $this->taxBasisTotalAmount;
    }

    /**
     * Sets a new taxBasisTotalAmount
     */
    public function setTaxBasisTotalAmount(\horstoeko\zugferd\entities\minimum\udt\AmountType $taxBasisTotalAmount): self
    {
        $this->taxBasisTotalAmount = $taxBasisTotalAmount;
        return $this;
    }

    /**
     * Adds as taxTotalAmount
     */
    public function addToTaxTotalAmount(\horstoeko\zugferd\entities\minimum\udt\AmountType $taxTotalAmount): self
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
     * @return \horstoeko\zugferd\entities\minimum\udt\AmountType[]
     */
    public function getTaxTotalAmount()
    {
        return $this->taxTotalAmount;
    }

    /**
     * Sets a new taxTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\minimum\udt\AmountType[] $taxTotalAmount
     */
    public function setTaxTotalAmount(?array $taxTotalAmount = null): self
    {
        $this->taxTotalAmount = $taxTotalAmount;
        return $this;
    }

    /**
     * Gets as grandTotalAmount
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\AmountType
     */
    public function getGrandTotalAmount()
    {
        return $this->grandTotalAmount;
    }

    /**
     * Sets a new grandTotalAmount
     */
    public function setGrandTotalAmount(\horstoeko\zugferd\entities\minimum\udt\AmountType $grandTotalAmount): self
    {
        $this->grandTotalAmount = $grandTotalAmount;
        return $this;
    }

    /**
     * Gets as duePayableAmount
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\AmountType
     */
    public function getDuePayableAmount()
    {
        return $this->duePayableAmount;
    }

    /**
     * Sets a new duePayableAmount
     */
    public function setDuePayableAmount(\horstoeko\zugferd\entities\minimum\udt\AmountType $duePayableAmount): self
    {
        $this->duePayableAmount = $duePayableAmount;
        return $this;
    }
}
