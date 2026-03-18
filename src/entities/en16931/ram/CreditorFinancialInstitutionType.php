<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing CreditorFinancialInstitutionType
 *
 * XSD Type: CreditorFinancialInstitutionType
 */
class CreditorFinancialInstitutionType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $bICID
     */
    private $bICID;

    /**
     * Gets as bICID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getBICID()
    {
        return $this->bICID;
    }

    /**
     * Sets a new bICID
     */
    public function setBICID(\horstoeko\zugferd\entities\en16931\udt\IDType $bICID): self
    {
        $this->bICID = $bICID;
        return $this;
    }
}
