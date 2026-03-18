<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing DebtorFinancialAccountType
 *
 * XSD Type: DebtorFinancialAccountType
 */
class DebtorFinancialAccountType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $iBANID
     */
    private $iBANID;

    /**
     * Gets as iBANID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getIBANID()
    {
        return $this->iBANID;
    }

    /**
     * Sets a new iBANID
     */
    public function setIBANID(\horstoeko\zugferd\entities\en16931\udt\IDType $iBANID): self
    {
        $this->iBANID = $iBANID;
        return $this;
    }
}
