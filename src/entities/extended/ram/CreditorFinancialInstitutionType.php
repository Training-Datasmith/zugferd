<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing CreditorFinancialInstitutionType
 *
 * XSD Type: CreditorFinancialInstitutionType
 */
class CreditorFinancialInstitutionType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $bICID
     */
    private $bICID;

    /**
     * Gets as bICID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getBICID()
    {
        return $this->bICID;
    }

    /**
     * Sets a new bICID
     */
    public function setBICID(\horstoeko\zugferd\entities\extended\udt\IDType $bICID): self
    {
        $this->bICID = $bICID;
        return $this;
    }
}
