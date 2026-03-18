<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing CreditorFinancialAccountType
 *
 * XSD Type: CreditorFinancialAccountType
 */
class CreditorFinancialAccountType
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $iBANID
     */
    private $iBANID;

    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $proprietaryID
     */
    private $proprietaryID;

    /**
     * Gets as iBANID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function getIBANID()
    {
        return $this->iBANID;
    }

    /**
     * Sets a new iBANID
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\IDType $iBANID
     */
    public function setIBANID(?\horstoeko\zugferd\entities\basic\udt\IDType $iBANID = null): self
    {
        $this->iBANID = $iBANID;
        return $this;
    }

    /**
     * Gets as proprietaryID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function getProprietaryID()
    {
        return $this->proprietaryID;
    }

    /**
     * Sets a new proprietaryID
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\IDType $proprietaryID
     */
    public function setProprietaryID(?\horstoeko\zugferd\entities\basic\udt\IDType $proprietaryID = null): self
    {
        $this->proprietaryID = $proprietaryID;
        return $this;
    }
}
