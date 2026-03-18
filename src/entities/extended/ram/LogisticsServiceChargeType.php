<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LogisticsServiceChargeType
 *
 * XSD Type: LogisticsServiceChargeType
 */
class LogisticsServiceChargeType
{
    /**
     * @var string $description
     */
    private $description;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $appliedAmount
     */
    private $appliedAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $appliedTradeTax
     */
    private $appliedTradeTax = [

    ];

    /**
     * Gets as description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets a new description
     *
     * @param  string $description
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets as appliedAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getAppliedAmount()
    {
        return $this->appliedAmount;
    }

    /**
     * Sets a new appliedAmount
     */
    public function setAppliedAmount(\horstoeko\zugferd\entities\extended\udt\AmountType $appliedAmount): self
    {
        $this->appliedAmount = $appliedAmount;
        return $this;
    }

    /**
     * Adds as appliedTradeTax
     */
    public function addToAppliedTradeTax(\horstoeko\zugferd\entities\extended\ram\TradeTaxType $appliedTradeTax): self
    {
        $this->appliedTradeTax[] = $appliedTradeTax;
        return $this;
    }

    /**
     * isset appliedTradeTax
     *
     * @param  int|string $index
     */
    public function issetAppliedTradeTax($index): bool
    {
        return isset($this->appliedTradeTax[$index]);
    }

    /**
     * unset appliedTradeTax
     *
     * @param  int|string $index
     */
    public function unsetAppliedTradeTax($index): void
    {
        unset($this->appliedTradeTax[$index]);
    }

    /**
     * Gets as appliedTradeTax
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeTaxType[]
     */
    public function getAppliedTradeTax()
    {
        return $this->appliedTradeTax;
    }

    /**
     * Sets a new appliedTradeTax
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $appliedTradeTax
     */
    public function setAppliedTradeTax(array $appliedTradeTax): self
    {
        $this->appliedTradeTax = $appliedTradeTax;
        return $this;
    }
}
